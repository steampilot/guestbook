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

	public function __construct(){
		$model = new UserModel();
		parent::__construct($model);
	}
	public function index(){
		$this->setViewVars("users", $this->model->getAll());
		$this->setViewVars('jumbo', array(
				'text' => "Hello Admin! Create a new User!",
				'btn-text' => 'Create New User',
				'btn-url' => __BASE_URL__.'User/add'
			));
		$this->addViewFile(__VIEW__.'/ViewElement/jumbotron.html.php');
		$this->addViewFile(__VIEW__.'/User/index.html.php');

		$this->render();
	}
	public function view($id) {
		$this->setViewVars('user', $this->model->getOne($id));
		$this->addViewFile(__VIEW__.'/User/view.html.php');
		$this->render();
	}

	public function add() {
		if(!empty($_POST)){
		}
		$this->setViewVars('users', $this->model->getAll());
		$this->setViewVars('jumbo', array(
				'title' => 'SPGB',
				'text' => 'Create new user!',
				'submit-url' => __BASE_URL__.'User/add'
			));
		$this->addViewFile(__VIEW__.'/ViewElement/jumbo-form.html.php');
		$this->addViewFile(__VIEW__.'/User/add.html.php');
		$this->render();
		// TODO: Implement add() method.
	}

	public function edit($id = null)
	{
		// TODO: Implement edit() method.
	}

	public function delete($id)
	{
		// TODO: Implement delete() method.
	}
}