<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

/**
 * Class PostController
 * @package Controller
 */
class UserController extends Controller {

	/**
	 * @var \Model\UserModel
	 */
	protected $model;
	protected $validateError;

	public function __construct($params) {
		$modelName = array('User','Users');
		parent::__construct($params,$modelName);
	}

	public function index() {
		if($_SESSION['sessionUserId'] == 1) {
			parent::index();
		} else {
			$this->setAlert('error' ,array(
				'title' => 'ACCESS DENIED',
				'text' => 'Only admins are able to view this page'
			));
			$this->redirect('Post','index');
		}

	}

	public function view() {
		parent::view();
	}

	/**
	 * @uses \Model\UserModel::getAuthor() to retrieve data about the creator of the post.
	 */
	public function add(){
		if ($this->method === 'GET') {
			$this->render('add');
		} else if ($this->method === 'POST'){
			if($this->validate('uniqueEmail')){
				$affected = $this->model->create($_POST);
				if($affected >=1) {
					$result = $this->model->getOneByEmail($_POST['email']);
					$_SESSION['sessionUserId'] = $result['id'];
					$_SESSION['active'] = true;
					$this->setAlert('success', array(
						'title' => 'REGISTRATION SUCCESS!',
						'text' => 'Welcome: '. $_POST['name']. ' you are now able to post messages'
					));
					$this->redirect();
				} else {
					$this->setAlert('error');
					$this->redirect();
				}
			} else {
				$this->setAlert('error',array(
					'title'=> 'EMAIL USED',
					'text' => 'this email is already registered. Pls login or contact the admin in case you
					forgot your credentials.'
				));
				$this->set('user',$_POST);
				$this->redirect('User','add');
			}
		}
	}
	public function edit(){
		if ($this->method === 'GET'){
			if ($this->GET === null ) {
				$this->setAlert('error', array(
					'title' => 'NOT FOUND',
					'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect();
			} else {
				$id = intval($this->GET['id']);
				$data = $this->model->getOne($id);
				if ($data === null){
					$this->setAlert('error', array(
						'title' => 'NOT FOUND',
						'text' => 'Post Nr: '. $id . ' could not be found.'
					));
					$this->redirect();
				} else {
					$this->set(strtolower($this->modelName), $data);
					$this->render('edit');
				}
			}
		}
		if ($this->method === 'POST'){
			if($this->model->checkPassword($_POST['id'],$_POST['password-old'])){
				echo 'save the new passwort';
				$affected = $this->model->update($_POST);
				if($affected >=1) {
					$this->setAlert('success', array(
						'title' => 'PASSWORD CHANGED',
						'text' => 'The Password for ' .$_POST['name']. ' has been changed.'
					));
				}
				$this->redirect();
			} else {
				$this->setAlert('error', array(
					'title' => 'Password incorrect',
					'text' => 'the old password is incorrect'
				));
				$this->set('user',$_POST);
				$this->redirect('User','edit',$_POST['id']);
			}
		}
	}

	public function validate($validation = null){
		if($validation ==='uniqueEmail'){
			$result = $this->model->getOneByEmail($_POST['email']);
			if ($result === null){
				return true;
			} else {
				return false;
			}
		}
		if($validation ==='sameEmail'){
			$result = $this->model->getOne($_POST['id']);
				if ($result['email'] === $_POST['email']){
				return true;
			} else {
			} return false;
		}
		return null;
	}


}