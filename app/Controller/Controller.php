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
		var_dump($this);
	}
	public abstract function index_GET();
	public abstract function view_GET($id);
	public abstract function add_GET();
	public abstract function add_POST();
	public abstract function edit_GET($id);
	public abstract function edit_POST($id);
	public abstract function delete_GET($id);
} 