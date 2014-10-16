<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 16.10.14
 * Time: 12:35
 */

namespace Controller;



class SessionController extends Controller{
	public function __construct($params) {
		$modelName = array('User','Users');
		parent::__construct($params,$modelName);
	}

	public function login(){
		echo'action = login method=post';
		if($this->method === 'POST' && isset($_POST['login_email'])) {
			$data = $this->model->getOneByEmail($_POST['login_email']);
			if (empty($data)){
				$_SESSION['sessionUserId'] = null;
				$_SESSION['active'] = false;
				$this->setAlert('error', array(
					'title' => 'ACCESS DENIED',
					'text' => 'Come on you must do better than this to hack this site!'
				));
				$this->redirect();
			} else {
				$_SESSION['sessionUserId'] = $data['id'];
				$_SESSION['active'] = true;
				$this->setAlert('success', array(
					'title' => 'ACCESS GRANTED',
					'text' => 'You did remember your email and your password after all!'
				));
				$this->redirect();
			}
		}


	}
	public function logout(){
		session_destroy();
	$this->redirect();
	}

} 