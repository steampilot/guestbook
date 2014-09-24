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
	/**
	 * @var \Steampilot\Util\Template The template to be rendered
	 */
	protected  $tpl;
	/**
	 * @var \Model\Model Holds the model data
	 */
	protected $modelName;
	/**
	 * @var $model \Model\Model
	 */
	protected $model;
	protected $view;
	protected $method;
	protected $GET = null;
	protected $POST = null;
	/**
	 * Constructor
	 *
	 * Child instances need to set the model for they specific controllers
	 */
	public function __construct($params = null,$modelName = null) {
		if(empty($modelName)){
			echo 'Model name is not set';
			exit;
		} else {
			$this->modelName = $modelName;
			$model = '\Model\\'.$modelName.'Model';
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
	protected function addElement($elementName,$params = array()){
		var_dump($params);
			$this->set($elementName,$params);
		$this->tpl->addViewFile(__VIEW__.'/ViewElement/'.$elementName.'.html.php');
	}
	protected function render($view){
		$this->tpl->addViewFile(__VIEW__.'/'.
			$this->modelName.'/'.$view.'.html.php');
		$this->tpl->render();
	}
	public abstract function index();

	public abstract function view();

	public abstract function add();

	public abstract function edit();

	public abstract function delete();
}