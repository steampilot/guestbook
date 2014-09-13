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
	public function index(){
		$postModel = new PostModel();
		$posts = $postModel->getAll();
		$file['layout'] = __DIR__.'/../View/layout.html.php';
		$tpl = new Template();
		$tpl->set("posts", $posts);
		//$tpl->render($file['content']);
		$tpl->render($file['layout']);
	}
	public function view() {

	}
	public function add() {

	}
	public function delete() {

	}
} 