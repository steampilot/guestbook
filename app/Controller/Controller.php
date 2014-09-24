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

	/**
	 * Constructor
	 *
	 * Child instances need to set the model for they specific controllers
	 */
	public function __construct() {
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
	/**
	 * Prepares and renders the view vor listing all records of a table
	 *
	 * @param null | array $params
	 * @return void
	 */
	public abstract function index($params = null);

	/**
	 * Prepares and renders the view for listing a single record of a table
	 *
	 * @param array | array $params
	 * @return Void
	 */
	public abstract function view($params = null);

	/**
	 * Prepares and renders the view for adding a new record for a table
	 *
	 * @param null | array $params
	 * @return void
	 */
	public abstract function add($params = null);

	/**
	 * Prepares and renders the view for editing a given record of a table
	 * @param array | array $params
	 * @return void
	 */
	public abstract function edit($params = null);

	/**
	 * Prepares and renders the view for deleting a given record of a table
	 *
	 * @param array | array $params
	 * @return void
	 */
	public abstract function delete($params = null);
}