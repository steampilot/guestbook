<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

use Config\Config;
use Model\UserModel;
use Steampilot\Util\ErrorWidget;

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
		parent::index();
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
					$result = $this->model->getOneByEmail($_POST);
					$_SESSION['sessionUserId'] = $result['id'];
					$this->setAlert('success');
					$this->redirect();
				} else {
					$this->setAlert('error');
					$this->redirect();
				}
			} else {
				$this->setAlert('error',array(
					'title'=> 'EMAIL USED',
					'text' => 'this email is allready registered. Pls login with it or contact the admin in case you
					forgot your credentials.'
				));
				$this->set('user',$_POST);
				$this->redirect('User','add');
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
		return null;
	}
}