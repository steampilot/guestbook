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
use Steampilot\Util\Template;

class PostController extends Controller {

	public function __construct(){
		$model = new PostModel();
		parent::__construct($model);
	}
	public function index(){
		$this->setViewVars("posts", $this->model->getAll());
		$this->setViewVars('jumbo', array(
				'text' => "This is awesome!",
				'btn-text' => 'Create New Post',
				'btn-url' => __BASE_URL__.'Post/add'
			));
		$this->addViewFile(__VIEW__.'/ViewElement/jumbotron.html.php');
		$this->addViewFile(__VIEW__.'/Post/index.html.php');

		$this->render();
	}
	public function view($id) {
		$this->setViewVars("post", $this->model->getOne($id));
		$this->addViewFile(__VIEW__.'/Post/view.html.php');
		$this->render();
	}

	public function add() {
		if(!empty($_POST)){
		}
		$this->setViewVars('post', $this->model->getAll());
		$this->setViewVars('jumbo', array(
				'title' => 'SPGB',
				'text' => 'Write something cool!',
				'submit-url' => __BASE_URL__.'Post/add'
			));
		$this->addViewFile(__VIEW__.'/ViewElement/jumbo-form.html.php');
		$this->addViewFile(__VIEW__.'/Post/add.html.php');
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