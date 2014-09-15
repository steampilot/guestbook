<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;
use Model\PostModel;
use Steampilot\Util\Template;

class PostController {
	protected $model;
	protected $tpl;
	public function __construct(){
		$this->model = new PostModel();
		$this->tpl = new Template();
	}
	public function index(){
		$this->tpl->addViewFile('top',__VIEW__.'Post/top.html.php');
		$this->tpl->addViewFile('content',__VIEW__.'Post/index.html.php');
		$this->tpl->setViewVars("posts", $this->model->getAll());
		$this->tpl->render();
	}
	public function view($id) {
		$this->tpl->addViewFile('top', __VIEW__.'Post/top.html.php');
		$this->tpl->addViewFile('content', __VIEW__.'Post/view.html.php');
		$this->tpl->setViewVars("post", $this->model->getOne($id));
		$this->tpl->render();
	}
	public function add() {

	}
	public function delete() {

	}
} 