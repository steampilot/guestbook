<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 19.09.14
 * Time: 20:44
 */

namespace Controller;

use \Model;
use \Config\Config;


abstract class Controller
{
	/**
	 * @var \Steampilot\Util\Template $tpl The template object
	 */
	protected $tpl;

	/**
	 * @var string $modelName The name of the model in singular
	 */
	protected $modelName;
	/**
	 * @var string $modelNamePlural The name of the model in plural
	 */
	protected $modelNamePlural;
	/**
	 * @var \Model\Model The model object
	 */
	protected $model;
	/**
	 * @var string $view The name of the view that will be called.
	 */
	protected $view;

	/**
	 * @var string $http request method defaulds to POST | GET
	 */
	protected $method;

	/**
	 * @var Array|null|mixed The get request parameters
	 */
	protected $params;

	/**
	 * @var null|Array The GET parameters
	 */
	protected $GET = null;

	/**
	 * @var null|Array The POST parameters
	 */
	protected $POST = null;

	/**
	 * Constructor
	 * @param Array $params The parameters given by the request
	 * @param Array $modelNames A list of the model names in singular and plural
	 */
	public function __construct($params = null, $modelNames = null)
	{
		/**
		 * Start the session first before anithyng else
		 */
		$this->startSession();

		/**
		 * Accept the request parameters and checking if the extending controller has its model name set
		 */
		$this->params = $params;
		if (empty($modelNames)) {
			echo 'Model name is not set';
			exit;
		} else {
			$this->modelNamePlural = $modelNames[1];
			$this->modelName = $modelNames[0];
			$model = '\Model\\' . $this->modelName . 'Model';
			$this->model = new $model();
		}
		if (isset($params['GET'])) {
			$this->GET = $params['GET'];
		}
		if (isset($params['POST'])) {
			$this->POST = $params['POST'];
		}
		/**
		 * Prepare the template object and set the main layout
		 */
		$this->tpl = \App::getTpl();
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->tpl->setLayout(__VIEW__ . '/layout.html.php');
		$this->tpl->setViewVars(
			'app', array(
				'title' => Config::get('app.name'),
				'version' => "TODO put version into config",
				'today' => date('Y-m-d h:m:s')
			)
		);

		/**
		 * Set up alert view elements if they are set
		 */
		if (isset($_SESSION['alert'])) {

			$this->addElement($_SESSION['alert']['type'], $_SESSION['alert']['params']);
			$_SESSION['alert'] = null;
			unset($_SESSION['alert']);
		}
	}

	/**
	 * Gets the template object
	 *
	 * @return \Steampilot\Util\Template
	 */
	protected function getTpl()
	{
		return $this->tpl;
	}

	/**
	 * Gets the model
	 *
	 * @return \Model\Model The model object
	 */
	protected function getModel()
	{
		return $this->model;
	}

	/**
	 * Sets view vars
	 *
	 * View vars will be passed on to the view
	 *
	 * @param $key
	 * @param $value
	 * @return void
	 */
	protected function set($key, $value)
	{
		$this->tpl->setViewVars($key, $value);
	}

	/**
	 * Adds a view element to the template render list
	 *
	 * @param string $elementName The name of the element. This will in some case determine  where the element will be placed
	 * @param null|Array $params The customizable parameters of a view element.
	 */
	protected function addElement($elementName, $params = null)
	{
		$this->set($elementName, $params);
		$this->tpl->addViewFile(__VIEW__ . '/ViewElement/' . $elementName . '.html.php');
	}

	/**
	 * Sets a alert message ontop of the view under the nav bar
	 *
	 * According to the type, the corresponding view element will be loaded in this case its either 'error' or 'success'
	 * @param string $type The type of the message. Defaults to error.
	 * @param array $params The custom parameters for setting the title and the text of the alert message
	 */
	protected function setAlert($type = 'error', array $params = null)
	{
		$_SESSION['alert'] = array(
			'type' => $type,
			'params' => $params,
		);
	}

	/**
	 * Renders the view
	 * @param $view
	 */
	protected function render($view)
	{
		$this->tpl->addViewFile(__VIEW__ . '/' .
			$this->modelName . '/' . $view . '.html.php');
		$this->tpl->render();

		exit;
	}

	/**
	 * Redirects and places a new http request
	 *
	 * As it is in this design, only a controller, its action and its corresponding parameter can be accessed
	 * @param string $controller The name of the controller to be called
	 * @param string $action The name of the action to be executed
	 * @param null|mixed $param The parameter that the corresponding action is expecting
	 */
	protected function redirect($controller = 'Post', $action = 'index', $param = null)
	{
		if ($param !== null) {
			$param = '?id=' . $param;
		}
		header('Location: ' . __BASE_URL__ . $controller . '/' . $action . $param);
		die();
	}

	/**
	 * The CRUD Index action
	 *
	 * Retrieves and sets up the list view to display the records.
	 */
	public function index()
	{

		$this->set(strtolower($this->modelNamePlural), $this->model->getAll());

		$this->render('index');
	}

	/**
	 * The CRUD View action
	 *
	 * Retrieves and sets up the view to display one record.
	 * By using $this->GET['id'] it is made sure the parameter are sanitized.
	 * If the record could not be found a alert message will be displayed and redirected.
	 */
	public function view()
	{
		if ($this->GET === null) {
			$this->setAlert('error', array(
				'title' => 'NOT FOUND',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
			$this->redirect();
		} else {
			$id = intval($this->GET['id']);
			$data = $this->model->getOne($id);
			if ($data === null) {
				$this->setAlert('error', array(
					'title' => 'NOT FOUND',
					'text' => 'Entry could not be found'
				));
				$this->redirect();
			} else {
				$this->set(strtolower($this->modelName), $data);
				$this->render('view');
			}
		}
	}

	/**
	 * The CRUD Add action
	 *
	 * Processes the incoming data and passes it to the model in order to create a new record
	 */
	public function add()
	{
		if ($this->method === 'GET') {
			$this->render('add');
		} else if ($this->method === 'POST') {
			$affected = $this->model->create($_POST);
			if ($affected >= 1) {
				$this->setAlert('success', array(
					'title' => 'Created',
					'text' => 'New entry has been created'
				));
			} else {
				$this->setAlert('error', array(
					'title' => 'ERROR',
					'text' => 'Could not create new entry'
				));
			}
			$this->redirect();
		}
	}

	/**
	 * The CRUD Edit action
	 *
	 * Processes the incoming data and end modifies a record
	 */
	public function edit()
	{
		if ($this->method === 'GET') {
			if ($this->GET === null) {
				$this->setAlert('error', array(
					'title' => 'NOT FOUND',
					'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect();
			} else {
				$id = intval($this->GET['id']);
				$data = $this->model->getOne($id);
				if ($data === null) {
					$this->setAlert('error', array(
						'title' => 'NOT FOUND',
						'text' => 'Post Nr: ' . $id . ' could not be found.'
					));
					$this->redirect();
				} else {
					$this->set(strtolower($this->modelName), $data);
					$this->render('edit');
				}
			}
		}
		if ($this->method === 'POST') {
			$affected = $this->model->update($_POST);
			if ($affected >= 1) {
				$this->setAlert('success', array(
					'title' => 'SUCCESS',
					'text' => 'Message id: ' . $_POST['id'] . ' has been modified'
				));
			} else {
				$this->setAlert('error');
			}
			$this->redirect();
		}
	}

	/**
	 * The CRUD Delete action
	 *
	 */
	public function delete()
	{
		if ($this->GET === null) {
			$this->setAlert('error', array(
				'title' => 'NOT FOUND',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
			$this->redirect('index');
		} else {
			$id = intval($this->GET['id']);
			$data = $this->model->getOne($id);
			if ($data === null) {
				$this->setAlert('error', array(
					'title' => 'Record not found',
					'text' => 'Record ' . $id . ' could not be deleted.'
				));
				$this->redirect();
			} else {
				$affected = $this->model->delete($id);
				if ($affected >= 1) {
					$this->setAlert('success', array(
						'title' => 'SUCCESS',
						'text' => 'Record ' . $id . ' has been deleted'
					));
				} else {
					$this->setAlert('error', array(
						'title' => 'ERROR',
						'text' => 'Could not delete Record' . $id
					));
				}
				$this->redirect();
			}
		}
	}

	/**
	 * Starts the Session
	 *
	 * While it is used in all controllers through out the application this is the right place to put it
	 */
	public function startSession()
	{
		session_name('SPGB-Guestbook');

		session_start();
	}

	/**
	 * Destroys the session.
	 */
	public function destroySession()
	{
		session_destroy();
	}
}