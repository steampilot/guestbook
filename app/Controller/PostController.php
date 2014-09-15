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
        $viewFile = __DIR__.'/../View/Post/index.html.php';
        $key = 'content';
        $tpl = new Template();
        $tpl->init();
		$tpl->set("posts", $posts);
        $tpl->setContent($key,$viewFile);
		$tpl->render();
	}
	public function view() {

	}
	public function add() {

	}
	public function delete() {

	}
} 