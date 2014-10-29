<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 16.10.14
 * Time: 12:35
 */

namespace Controller;

/**
 * Class SessionController
 *
 * Controls the session factory
 * @package Controller
 */
class SessionController extends Controller
{
	/**
	 * @var \Model\UserModel $model Just so that the IDE knows what functions are corresponding wit that model
	 */
	protected $model = '';

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
	 * Performs the login
	 */
	public function login()
	{
		if ($this->method === 'POST' && isset($_POST['login_email'])) {
			$data = $this->model->getOneByEmail($_POST['login_email']);
			if (empty($data)) {
				$_SESSION['sessionUserId'] = null;
				$_SESSION['active'] = false;
				$this->setAlert('error', array(
					'title' => 'ACCESS DENIED',
					'text' => 'No Email found witch means that we have no idea who you are and what you want.'
				));
				$this->redirect('Post', 'index');
			} else {
				if (verify_password_hash($_POST['login_password'], $data['password'])) {
					$_SESSION['sessionUserId'] = $data['id'];
					$_SESSION['active'] = true;
					$this->setAlert('success', array(
						'title' => 'ACCESS GRANTED',
						'text' => 'You did remember your email and your password after all!'
					));
					$this->redirect('Post', 'index');
				} else {
					$this->setAlert('error', array(
						'title' => 'ACCESS DENIED',
						'text' => 'Wrong Password! No panic, just keep calm and think. Its somewhere lost in your
						head.'
					));
					$_SESSION['sessionUserId'] = null;
					$_SESSION['active'] = false;
					$this->redirect('Post', 'index');
				}
			}
		}
	}

	/**
	 * Performs the logout
	 */
	public function logout() {
		$this->destroySession();
		$this->startSession();
		$this->setAlert('success', array(
			'title' => 'LOGGED OUT',
			'text' => 'Despite of all the fun you had posting strange and crazy stuff on this message board. You
			decided that it is enough for today. And You know what? We think that is a good idea. That\'s why we say
			goodbye and as always: Thank you for posting!'
		));
		$this->redirect('Post', 'Index');
	}
}