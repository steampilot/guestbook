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
		$this->tpl->setViewVars('app', array('title'=> Config::get('app.name')));

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
	protected function render($view){
		$this->tpl->addViewFile(__VIEW__.'/'.
			$this->modelName.'/'.$view.'.html.php');
		$this->tpl->render();
		exit;
	}
	protected function redirect($action, $params = null){
		$controller = '\Controller\\'.$this->modelName.'Controller';
		if($params === null) {
			$params = $this->params;
		}
		$controller = new $controller($params);
		if (!method_exists($controller, $action) || (!is_callable(array($controller, $action)))) {
			echo "Page not found";
			exit;
		}
		$controller->$action();
	}

	public function index(){
		$this->set(strtolower($this->modelNamePlural), $this->model->getAll());
		$this->render('index');
	}

	public function view() {
		if ($this->GET === null ) {
			$this->addElement('error', array(
				'title' => 'NOT FOUND',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect('index');
		} else {
			$id = intval($this->GET['id']);
			$data = $this->model->getOne($id);
			if ($data === null){
				$this->addElement('error');
				$this->redirect('index');
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
			$query = $this->model->create($_POST);
			$this->set('query',$query );
			$this->redirect('index');
		}
	}

	public abstract function edit();

	public abstract function delete();
}