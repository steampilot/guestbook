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
	public function __construct($param) {
		parent::__construct($param);
		$this->model = new PostModel();
	}

	public function index() {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		$tpl->setViewVars("posts", $model->getAll());
		$tpl->setViewVars('jumbo', array(
			'text' => "Welcome! Lets see what peoples like You think about!",
			'btn-text' => 'List all posts',
			'btn-url' => __BASE_URL__ . 'Post/index'
		));
		$tpl->addViewFile(__VIEW__ . '/ViewElement/jumbo.html.php');
		$tpl->render();
	}

	public function view() {
		// TODO: Implement view() method.
	}

	public function add() {
		// TODO: Implement add() method.
	}

	public function edit() {
		// TODO: Implement edit() method.
	}

	public function delete() {
		// TODO: Implement delete() method.
	}
}