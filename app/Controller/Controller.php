<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 19.09.14
 * Time: 20:44
 */

namespace Controller;
use \Config\Config;


abstract class Controller {
	/**
	 * @var \Steampilot\Util\Template The template to be rendered
	 */
	public $tpl;
	/**
	 * @var \Model\Model Holds the model data
	 */
	public $model;
	protected $method;
	protected $GET = null;
	protected $POST = null;
	/**
	 * Constructor
	 *
	 * Child instances need to set the model for they specific controllers
	 */
	public function __construct($params) {
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
	public abstract function index();

	public abstract function view();

	public abstract function add();

	public abstract function edit();

	public abstract function delete();
}