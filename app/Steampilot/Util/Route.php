<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 16.09.14
 * Time: 18:32
 */

namespace Steampilot\Util;
use Controller\PostController;
use \Steampilot\Util\Debug;


class Route {
	protected $uri;
	protected $controller;
	protected $action;
	protected $params;
	public function __construct($uri) {
		$this->uri = $uri;
		self::parseUri($this->uri);
		self::callController();
	}
	protected function parseUri($uri){
		$parsedUri = explode('/',parse_url($uri)['path']);
		if(!empty($parsedUri[2])){
			$this->controller = $parsedUri[2];
		}
		if(isset($parsedUri[3])) {
			$this->action = $parsedUri[3];
		}
		$parsedParams = explode('&',(parse_url($uri, PHP_URL_QUERY) ? '&' : '') . http_build_query($_GET));
		foreach ($parsedParams as $pair ) {
			if(isset(explode('=',$pair)[1])){
				if (!empty(explode('=',$pair)[1])) {
					$this->params[explode('=',$pair)[0]] = explode('=',$pair)[1];
				}
				$this->params[explode('=',$pair)[0]] = true;
			}
		}
		var_dump($this->controller);
		var_dump($this->action);
		var_dump($this->params);


	}
	public function getController() {
		return $this->controller;
	}
	public function getAction() {
		return $this->action;
	}
	public function getParams() {
		return $this->params;
	}
	protected function callController(){
		switch ($this->controller) {
			case 'Post':
				$post = new PostController();
				switch ($this->action) {
					case 'index':
						$post->index();
						break;
					case 'view':
						$post->view($this->params['id']);
						break;
				}
				break;
		}
		//$controller = new $this->controller();
		//$controller->$this->action($this->param);
	}
	public function handle() {

	}
} 