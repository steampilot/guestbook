<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 19.09.14
 * Time: 20:44
 */

namespace Controller;
use \Steampilot\Util\Template;
use \Config\Config;


abstract class Controller extends Template{
	protected $model;
	public function __construct($model= null) {
		$this->model = $model;
		$layoutFile = Config::get('layout.file');

		parent::__construct($layoutFile);
		$this->setViewVars('app', array('title'=> Config::get('app.name')));
	}
	public abstract function index();
	public abstract function view($id);
	public abstract function add();
	public abstract function edit($id);
	public abstract function delete($id);
} 