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
 * Controls all the features for showing guest book posts
 * @package Controller
 */
class PostController extends Controller
{

	/**
	 * The model object it dos not hold any data it is just here so that the IDE knows which controller it is coming from
	 * @var \Model\PostModel The model object
	 */
	protected $model;

	/**
	 * @var string $validate The error message for the validation
	 */
	protected $validate;

	/**
	 * The Constructor
	 *
	 * Sets up the model name for the parent controller
	 * @param Array|null $params
	 */
	public function __construct($params)
	{
		$modelName = array('Post', 'Posts');
		parent::__construct($params, $modelName);
	}

	/**
	 * The CRUD Index action
	 *
	 * Customized welcome message
	 */
	public function index()
	{
		if (isset($_SESSION['sessionUserId'])) {
			$user = $this->model->getAuthor($_SESSION['sessionUserId']);
			$this->addElement('jumbo', array(
				'title' => 'SPGB - Hello ' . $user['name'] . ' and welcome!',
				'text' => "This is awesome!",
				'btn-text' => 'Create New Post',
				'btn-url' => __BASE_URL__ . 'Post/add'
			));
		} else {
			$this->addElement('jumbo', array(
				'title' => 'Contribute Now!',
				'text' => 'Register now to write something to this guest book or Login with your account',
				'btn-text' => 'Register',
				'btn-url' => __BASE_URL__ . 'User/add'
			));
		}
		parent::index();
	}

	/**
	 * The CRUD View action
	 *
	 * Defaulds to the parent view action
	 */
	public function view()
	{
		parent::view();
	}

	/**
	 * The CRUD Add action
	 *
	 * Retrieves custom author information to display next to a specific post
	 * @uses \Model\PostModel::etAuthor() to retrieve data about the creator of the post.
	 */
	public function add()
	{
		$this->set("author", $this->model->getAuthor($_SESSION['sessionUserId']));
		if ($this->method === 'POST') {
			$this->validate();
		}
		parent::add();
	}

	/**
	 * The CRUD Edit action
	 */
	public function edit()
	{
		parent::edit();
	}

	/**
	 * The CRUD Delete action
	 */
	public function delete()
	{
		parent::delete();
	}

	/**
	 * Validates the incoming data from post
	 *
	 */
	public function validate()
	{
		if (empty($_POST['subject'])) {
			$this->validate['subject'] = "Subject must not be empty";
		}
		if (strlen($_POST['subject']) > 255) {
			$this->validate['subject'] = "Subject must not be longer than 255 characters";
		}
		if (empty($_POST['message'])) {
			$this->validate['message'] = "Message must not be empty";
		}
		if (strlen($_POST['message']) > 1024) {
			$this->validate['message'] = "Message must not be longer than 1024";
		}
	}
}