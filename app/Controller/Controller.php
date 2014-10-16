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


abstract class Controller {
	protected $tpl;
	protected $modelName;
	protected $modelNamePlural;
	/**
	 * @var \Model\Model The model object
	 */
	protected $model;
	protected $view;
	protected $method;
	protected $params;
	protected $GET = null;
	protected $POST = null;

	/**
	 * Constructor
	 * @param Array $params The parameters given by the request
	 * @param Array $modelNames A list of the model names in singular and plural
	 */
	public function __construct($params = null,$modelNames = null) {
		$this->params = $params;
		if(empty($modelNames)){
			echo 'Model name is not set';
			exit;
		} else {
			$this->modelNamePlural = $modelNames[1];
			$this->modelName = $modelNames[0];
			$model = '\Model\\'.$this->modelName.'Model';
			$this->model = new $model();
		}
		if(isset($params['GET'])){
			$this->GET = $params['GET'];
		}
		if(isset($params['POST'])) {
			$this->POST = $params['POST'];
		}
		$this->tpl = \App::getTpl();
		$this->method = $_SERVER['REQUEST_METHOD'];
		$this->tpl->setLayout( __VIEW__.'/layout.html.php');
		$this->tpl->setViewVars(
			'app', array(
				'title'=> Config::get('app.name'),
				'version' => "TODO put version into config",
				'today' => date('Y-m-d h:m:s')
			)
		);
		if(isset($_SESSION['alert'])){

				$this->addElement($_SESSION['alert']['type'],$_SESSION['alert']['params']);
			/**
			 * Some how the controller gets loaded multiple times till the view is rendered
			 *
			 */
			$_SESSION['call_cycle'] ++;
			if($_SESSION['call_cycle'] >= 3){
				unset($_SESSION['alert']);
				$_SESSION['call_cycle'] = 0;
			}
		}
	}
	/**
	 * Gets the template object
	 *
	 * @return \Steampilot\Util\Template
	 */
	protected function getTpl() {
		return $this->tpl;
	}
	/**
	 * Gets the model
	 *
	 * @return \Model\Model The model object
	 */
	protected function getModel() {
		return $this->model;
	}
	protected function set($key,$value){
		$this->tpl->setViewVars($key,$value);
	}
	protected function addElement($elementName,$params = null ){
			$this->set($elementName,$params);
		$this->tpl->addViewFile(__VIEW__.'/ViewElement/'.$elementName.'.html.php');
	}
	protected function setAlert($type = 'error', array $params = null){
		$_SESSION['alert'] = array(
			'type' => $type,
			'params' => $params,
		);
	}
	protected function render($view){
		$this->tpl->addViewFile(__VIEW__.'/'.
			$this->modelName.'/'.$view.'.html.php');
		$this->tpl->render();

		exit;
	}
	protected function redirect($controller = 'Post', $action = 'index', $params = null) {
		header('Location: '.__BASE_URL__.$controller.'/'.$action);
		die();
	}

	public function index(){

		$this->set(strtolower($this->modelNamePlural), $this->model->getAll());

		$this->render('index');
	}

	public function view() {
		if ($this->GET === null ) {
			$this->setAlert('error', array(
				'title' => 'NOT FOUND',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect();
		} else {
			$id = intval($this->GET['id']);
			$data = $this->model->getOne($id);
			if ($data === null){
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
	public function add(){
		if ($this->method === 'GET') {
			$this->render('add');
		} else if ($this->method === 'POST'){
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
	public function edit() {
		if ($this->method === 'GET'){
			if ($this->GET === null ) {
				$this->setAlert('error', array(
					'title' => 'NOT FOUND',
					'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect();
			} else {
				$id = intval($this->GET['id']);
				$data = $this->model->getOne($id);
				if ($data === null){
					$this->setAlert('error', array(
						'title' => 'NOT FOUND',
						'text' => 'Post Nr: '. $id . ' could not be found.'
					));
					$this->redirect();
				} else {
					$this->set(strtolower($this->modelName), $data);
					$this->render('edit');
				}
			}
		}
		if ($this->method === 'POST'){
			$affected = $this->model->update($_POST);
			if ($affected >= 1) {
				$this->setAlert('success', array(
					'title' => 'SUCCESS',
					'text' => 'Message id: '. $_POST['id'].' has been modified'
				));
			} else {
				$this->setAlert('error');
			}
			$this->redirect();
		}
	}
	public function delete(){
		if ($this->GET === null ) {
			$this->setAlert('error', array(
				'title' => 'NOT FOUND',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
			$this->redirect('index');
		} else {
			$id = intval($this->GET['id']);
			$data = $this->model->getOne($id);
			if ($data === null){
				$this->setAlert('error', array(
					'title' => 'Record not found',
					'text' => 'Record '.$id.' could not be deleted.'
				));
				$this->redirect();
			} else {
				$affected = $this->model->delete($id);
				if($affected >= 1) {
					$this->setAlert('success', array(
						'title' => 'SUCCESS',
						'text' => 'Record '. $id . ' has been deleted'
					));
				} else {
					$this->setAlert('error', array(
						'title' => 'ERROR',
						'text' =>   'Could not delete Record'. $id
					));
				}
				$this->redirect();
			}
		}
	}
}