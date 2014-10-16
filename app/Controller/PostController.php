<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

use Config\Config;
use Model\PostModel;
use Steampilot\Util\ErrorWidget;

/**
 * Class PostController
 * @package Controller
 */
class PostController extends Controller {

	/**
	 * @var \Model\PostModel
	 */
	protected $model;
	protected $validateError;

	public function __construct($params) {
		$modelName = array('Post','Posts');
		parent::__construct($params,$modelName);
	}

	public function index() {
		if (isset($_SESSION['sessionUserId'])) {
			$this->addElement('jumbo', array(
				'title'=> 'SPGB - Hello and welcome!',
				'text' => "This is awesome!",
				'btn-text' => 'Create New Post',
				'btn-url' => __BASE_URL__ . 'Post/add'
			));
		} else {
			$this->addElement('jumbo', array(
				'title' => 'Contribute!',
				'text' => 'Register now to write something to this guest book or Login with your account',
				'btn-text' => 'Register',
				'btn-url' => __BASE_URL__. 'User/add'
			));
		}
		parent::index();
	}

	public function view() {
		parent::view();
	}

	/**
	 * @uses \Model\PostModel::getAuthor() to retrieve data about the creator of the post.
	 */
	public function add(){
		$this->set("author", $this->model->getAuthor($_SESSION['sessionUserId']));
		if ($this->method === 'POST'){
			$this->validate();
		}
		parent::add();
	}

	public function edit() {
		parent::edit();
	}

	public function delete() {
		parent::delete();
	}
	public function validate() {
		if (empty($_POST['subject'])){
			$this->validateError['subject'] = "Subject must not be empty";
		}
		if (strlen($_POST['subject']) > 255){
			$this->validateError['subject'] = "Subject must not be longer than 255 characters";
		}
		if(empty($_POST['message'])) {
			$this->validateError['message'] = "Message must not be empty";
		}
		if (strlen($_POST['message']) > 1024) {
			$this->validateError['message'] = "Message must not be longer than 1024";
		}
	}
}