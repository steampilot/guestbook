<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

use Model\PostModel;
use Steampilot\Util\ErrorWidget;

class PostController extends Controller {

	public function __construct($params) {
		parent::__construct($params);
		$this->model = new PostModel();
	}

	public function index() {
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

	public function view() {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		if (empty($this->GET) || !isset($this->GET['id'])) {
			$tpl->addViewElement('ERROR', new ErrorWidget('NOT FOUND',
				'A Horde of monkeys has been dispatched to search for the missing record'));
		} else {
			$id = $this->GET['id'];
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

	public function add() {


	}

	public function edit() {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		// Post
		if(($this->method === 'POST') && ((!isset($this->POST) || empty($this->POST)))){
		}
		// GET
		if(($this->method === 'GET') && ((!isset($this->GET)|| empty($this->GET)))){
			$tpl->addViewElement('ERROR', new ErrorWidget('NOT FOUND','Couldnt find'));
			$tpl->render();
		}
		// anny other reason
		else {
			$tpl->addViewElement(new ErrorWidget());
			$tpl->render();
		}
	}

	public function delete() {
		$tpl = $this->getTpl();
		$model = $this->getModel();
		// TODO: Implement delete() method.
	}
}