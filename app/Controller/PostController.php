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

class PostController{
	protected $model;
	protected $tpl;
	public function __construct(){
		$this->model = new PostModel();
		$this->tpl = \App::getTpl();
	}
	public function index(){
		$this->tpl->setViewVars("posts", $this->model->getAll());
		$this->tpl->setViewVars('app', array('title'=> Config::get('app.name')));
		$this->tpl->setViewVars('jumbo', array(
				'text' => "This is awesome!",
				'btn-text' => 'Create New Post',
				'btn-url' => __BASE_URL__.'Post/add'
			));
		$this->tpl->addViewFile(__VIEW__.'/ViewElement/jumbotron.html.php');
		$this->tpl->addViewFile(__VIEW__.'/Post/index.html.php');

		$this->tpl->render();
	}
	public function view($id) {
		$this->tpl->setViewVars("post", $this->model->getOne($id));
		$this->tpl->addViewFile(__VIEW__.'/Post/view.html.php');
		$this->tpl->render();
	}
}