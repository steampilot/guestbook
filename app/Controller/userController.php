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
 *
 * Controls all the user related actions
 * @package Controller
 */
class UserController extends Controller
{

	/**
	 * @var \Model\UserModel The model object  so that the IDE knows what Class it derives from
	 */
	protected $model;
	protected $validateError;

	/**
	 * Constructor
	 * @param Array|null $params
	 */
	public function __construct($params)
	{
		$modelName = array('User', 'Users');
		parent::__construct($params, $modelName);
	}

	/**
	 * The CRUD Index action
	 *
	 * The admin is identified by its id
	 */
	public function index()
	{
		if ($_SESSION['sessionUserId'] == 1) {
			parent::index();
		} else {
			$this->setAlert('error', array(
				'title' => 'ACCESS DENIED',
				'text' => 'Only admins are able to view this page'
			));
			$this->redirect('Post', 'index');
		}
	}

	/**
	 * The CRUD View action
	 */
	public function view()
	{
		parent::view();
	}

	/**
	 * The CRUD Add action
	 *
	 * After successful registration the author will be logged in automatically
	 * The email must be unique. If some one uses a email that has been already registered
	 * an alert message gets displayed and the form will be re rendered
	 * @uses \Model\UserModel::getAuthor() to retrieve data about the creator of the post.
	 */
	public function add()
	{
		if ($this->method === 'GET') {
			$this->render('add');
		} else if ($this->method === 'POST') {
			if ($this->validate('uniqueEmail')) {
				$affected = $this->model->create($_POST);
				if ($affected >= 1) {
					$result = $this->model->getOneByEmail($_POST['email']);
					$_SESSION['sessionUserId'] = $result['id'];
					$_SESSION['active'] = true;
					$this->setAlert('success', array(
						'title' => 'REGISTRATION SUCCESS!',
						'text' => 'Welcome: ' . $_POST['name'] . ' you are now able to post messages'
					));
					$this->redirect();
				} else {
					$this->setAlert('error');
					$this->redirect();
				}
			} else {
				$this->setAlert('error', array(
					'title' => 'EMAIL USED',
					'text' => 'this email is already registered. Pls login or contact the admin in case you
					forgot your credentials.'
				));
				$this->set('user', $_POST);
				$this->redirect('User', 'add');
			}
		}
	}

	/**
	 * The CRUD Edit action for changing the password
	 *
	 * The user must retype its old password in order to set the new password.
	 */
	public function edit()
	{
		/**
		 * Process the if the record to change the password actually exists and if so renders the form
		 */
		if ($this->method === 'GET') {
			if ($this->GET === null) {
				$this->setAlert('error', array(
					'title' => 'NOT FOUND',
					'text' => 'A Horde of monkeys has been dispatched to search for the missing record'));
				$this->redirect();
			} else {
				$id = intval($this->GET['id']);
				$data = $this->model->getOne($id);
				if ($data === null) {
					$this->setAlert('error', array(
						'title' => 'NOT FOUND',
						'text' => 'Post Nr: ' . $id . ' could not be found.'
					));
					$this->redirect();
				} else {
					$this->set(strtolower($this->modelName), $data);
					$this->render('edit');
				}
			}
		}
		/**
		 * Processing the data coming from the form
		 */
		if ($this->method === 'POST') {
			if ($this->model->checkPassword($_POST['id'], $_POST['password-old'])) {
				$affected = $this->model->update($_POST);
				if ($affected >= 1) {
					$this->setAlert('success', array(
						'title' => 'PASSWORD CHANGED',
						'text' => 'The Password for ' . $_POST['name'] . ' has been changed.'
					));
				}
				$this->redirect();
			} else {
				$this->setAlert('error', array(
					'title' => 'Password incorrect',
					'text' => 'the old password is incorrect'
				));
				$this->set('user', $_POST);
				$this->redirect('User', 'edit', $_POST['id']);
			}
		}
	}

	/**
	 * Validates the data coming from the form
	 *
	 * For each data that has to be validated this function provides its own rules set.
	 * @param null $validation
	 * @return bool|null
	 * @todo Implement The whole function as a sort of switch cases and source it out into a class.
	 */
	public function validate($validation = null)
	{
		if ($validation === 'uniqueEmail') {
			$result = $this->model->getOneByEmail($_POST['email']);
			if ($result === null) {
				return true;
			} else {
				return false;
			}
		}
		if ($validation === 'sameEmail') {
			$result = $this->model->getOne($_POST['id']);
			if ($result['email'] === $_POST['email']) {
				return true;
			} else {
			}
			return false;
		}
		return null;
	}
}