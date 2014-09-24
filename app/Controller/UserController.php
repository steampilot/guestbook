<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

use Model\UserModel;


class UserController extends Controller {

	public function __construct() {
		parent::__construct($model);
		$this->model = new UserModel();
	}

	public function index() {
		$this->tpl->setViewVars("users", $this->model->getAll());
		$this->tpl->setViewVars('jumbo', array(
			'text' => "Hello Admin! Create a new User!",
			'btn-text' => 'Create New User',
			'btn-url' => __BASE_URL__ . 'User/add'
		));
		$this->tpl->addViewFile(__VIEW__ . '/ViewElement/jumbotron.html.php');
		$this->tpl->addViewFile(__VIEW__ . '/User/index.html.php');

		$this->tpl->render();
	}

	public function view($params = null) {
		$this->tpl->setViewVars('user', $this->model->getOne($id));
		$this->tpl->addViewFile(__VIEW__ . '/User/view.html.php');
		$this->tpl->render();
	}

	public function add($params = null) {
		if (!empty($_POST)) {
		}
		$this->tpl->setViewVars('users', $this->model->getAll());
		$this->tpl->setViewVars('jumbo', array(
			'title' => 'SPGB',
			'text' => 'Create new user!',
			'submit-url' => __BASE_URL__ . 'User/add'
		));
		$this->tpl->addViewFile(__VIEW__ . '/ViewElement/jumbo-form.html.php');
		$this->tpl->addViewFile(__VIEW__ . '/User/add.html.php');
		$this->tpl->render();
		// TODO: Implement add() method.
	}

	public function edit($params = null) {
		// TODO: Implement edit() method.
	}

	public function delete($params = null) {
		// TODO: Implement delete() method.
	}
}