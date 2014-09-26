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
use Steampilot\Util\ErrorWidget;

class PostController extends Controller {

	public function __construct($params) {
		$modelName = array('Post','Posts');
		parent::__construct($params,$modelName);
	}

	public function index() {
		$this->addElement('jumbo', array(
			'title'=> Config::get('app.name'),
			'text' => "This is awesome!",
			'btn-text' => 'Create New Post',
			'btn-url' => __BASE_URL__ . 'Post/add'
		));
		parent::index();
	}

	public function view() {
		parent::view();
	}
	public function add(){}

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