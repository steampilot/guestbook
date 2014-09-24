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

	public function __construct() {
		parent::__construct();
		$this->model = new PostModel();
	}

	public function index($params = null) {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		$tpl->setViewVars("posts", $model->getAll());
		$tpl->setViewVars('jumbo', array(
			'text' => "This is awesome!",
			'btn-text' => 'Create New Post',
			'btn-url' => __BASE_URL__ . 'Post/add'
		));
		$tpl->addViewFile(__VIEW__ . '/ViewElement/jumbotron.html.php');
		$tpl->addViewFile(__VIEW__ . '/Post/index.html.php');

		$tpl->render();
	}

	public function view($params = null) {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		if (empty($params) || !isset($params['id'])) {
			$tpl->setViewVars("error", array(
				'title' => 'Not Found',
				'text' => 'A Horde of monkeys has been dispatched to search for the missing record',
				'btn-url' => __BASE_URL__ . 'Post/index',
				'btn-text' => 'Go Back'
			));
			$tpl->addViewFile(__VIEW__ . '/ViewElement/error.html.php');
		} else {
			$id = $params['id'];
			$tpl->setViewVars("post", $model->getOne($id));
			$tpl->setViewVars('jumbo', array(
				'title' => 'View',
				'text' => 'Here is what XXX wrote on the XXXX at XXXX',
				'btn-url' => __BASE_URL__ . 'Post/index',
				'btn-text' => 'List all'
			));
			$tpl->addViewFile(__VIEW__ . '/ViewElement/jumbotron.html.php');
			$tpl->addViewFile(__VIEW__ . '/Post/view.html.php');
		}
		$tpl->render();
	}

	public function add($params = null) {


	}

	public function edit($params = null) {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		if($this->method === 'GET'){
			if (empty($params) || !isset($params['id'])) {
				$tpl->setViewVars("error", array(
					'title' => 'Not Found',
					'text' => "We even searched behind the old couch. Your record wasn't there",
					'btn-url' => __BASE_URL__ . 'Post/index',
					'btn-text' => 'Go Back'
				));
				$tpl->addViewFile(__VIEW__ . '/ViewElement/error.html.php');
			} else {
				$id = $params['id'];
				$tpl->setViewVars('post', $model->getOne($id));
				$tpl->addViewFile(__VIEW__.'/Post/edit.html.php');
			}
		}
		$tpl->render();
	}

	public function delete($params = null) {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		// TODO: Implement delete() method.
	}
}