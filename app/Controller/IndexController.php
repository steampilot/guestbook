<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:14
 */

namespace Controller;
use \Model\PostModel;
class IndexController extends Controller {
	public function __construct(){
		$model = new PostModel();
		parent::__construct($model);
	}
	public function index(){
		$this->setViewVars("posts", $this->model->getAll());
		$this->setViewVars('jumbo', array(
			'text' => "Welcome! Lets see what peoples like You think about!",
			'btn-text' => 'List all posts',
			'btn-url' => __BASE_URL__.'Post/index'
		));
		$this->addViewFile(__VIEW__.'/ViewElement/jumbotron.html.php');

		$this->render();
	}

	public function view($id)
	{
		// TODO: Implement view() method.
	}

	public function add()
	{
		// TODO: Implement add() method.
	}

	public function edit($id)
	{
		// TODO: Implement edit() method.
	}

	public function delete($id)
	{
		// TODO: Implement delete() method.
	}
}