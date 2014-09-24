<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:14
 */

namespace Controller;

use \Model\PostModel;

class IndexController extends Controller {
	public function __construct() {
		parent::__construct();
		$this->model = new PostModel();
	}

	public function index($params = null) {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		$tpl->setViewVars("posts", $model->getAll());
		$tpl->setViewVars('jumbo', array(
			'text' => "Welcome! Lets see what peoples like You think about!",
			'btn-text' => 'List all posts',
			'btn-url' => __BASE_URL__ . 'Post/index'
		));
		$tpl->addViewFile(__VIEW__ . '/ViewElement/jumbotron.html.php');
		$tpl->render();
		var_dump($_SERVER);
	}

	public function view($params = null) {
		// TODO: Implement view() method.
	}

	public function add($params = null) {
		// TODO: Implement add() method.
	}

	public function edit($params = null) {
		// TODO: Implement edit() method.
	}

	public function delete($params = null) {
		// TODO: Implement delete() method.
	}
}