<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 16.09.14
 * Time: 18:32
 */

namespace Steampilot\Util;

class Router {
	protected $uri;
	protected $controller;
	protected $action;
	protected $params;
	public function __construct($uri) {
		$this->uri = $uri;
		self::parseUri($this->uri);
		self::callControllerAction($this->controller,$this->action,$this->params);
	}
	protected function parseUri($uri) {
		$scriptNameCount = count(explode('/',$_SERVER['SCRIPT_NAME']))-1;
		$parsedUri = array_slice(explode('/',parse_url($uri)['path']),$scriptNameCount);
		$controller = '\Controller\\'.ucfirst(strtolower($parsedUri[0])).'Controller';
		if($controller === '\Controller\Controller'){
			$controller = '\Controller\IndexController';
		} else if(!class_exists($controller)){
			echo 'Controller <strong>'.$controller.'</strong> dos not exist';
			die;
		}
		$this->controller = $controller;
		if(!isset($parsedUri[1]) || $parsedUri[1] === ''){
			$this->action = 'index';
		} else {
			$this->action = $parsedUri[1];
		}
		$parsedParams = explode('&',(parse_url($uri, PHP_URL_QUERY) ? '&' : '') . http_build_query($_GET));
		foreach ($parsedParams as $pair ) {
			if(isset(explode('=',$pair)[1])){
				if (!empty(explode('=',$pair)[1])) {
					$this->params[explode('=',$pair)[0]] = explode('=',$pair)[1];
				} else {
					$this->params[explode('=',$pair)[0]] = true;
				}
			}
		}
		var_dump($this);
	}
	protected function callControllerAction(){
		$controller = new $this->controller();

		if (!empty($this->action)) {
			$action = $this->action;
			if (!method_exists($controller,$action) && (!is_callable(array($controller,$action)))){
				echo $action.' view is not implemented for '.$this->controller;
				die;
			} else if($action === 'index' || $action === 'add'){
				$controller->$action();
			} else if(isset($this->params['id'])){
				$controller->$action(intval($this->params['id']));
			} else {
				echo 'Id must be given';
				die;
			}
		}
	}
}
