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

	public function __construct($params) {
		$modelName = array('Post','Posts');
		parent::__construct($params,$modelName);
	}

	public function index() {
		$this->addElement('jumbo', array(
			'title'=> Config::get('app.name'),
			'text' => "This is awesome!",
			'btn-text' => 'Create New Post',
			'btn-url' => __BASE_URL__ . 'Post/add'
		));
		parent::index();
	}

	public function view() {
		parent::view();
	}

	/**
	 * @uses \Model\PostModel::getAuthor() to retrieve data about the creator of the post.
	 */
	public function add(){
		$this->set("author", $this->model->getAuthor($author_id = 2));
		parent::add();
	}

	public function edit() {
		parent::edit();
	}

	public function delete() {
		parent::delete();
	}
}