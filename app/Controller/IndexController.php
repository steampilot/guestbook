<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:14
 */

namespace Controller;
use Model\PostModel;
use \Steampilot\Util\Template;

class IndexController {
	public function index(){
		$postModel = new PostModel();
		$posts = $postModel->getAll();
		$file = __DIR__.'/../View/layout.html.php';
		$tpl = new Template();
		$tpl->set("posts", $posts);
		$tpl->render($file);
	}
} 