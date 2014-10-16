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
		parent::add();
	}

	public function edit() {

		parent::edit();
	}

	public function delete() {
		parent::delete();
	}
	public function validate() {
	}
}