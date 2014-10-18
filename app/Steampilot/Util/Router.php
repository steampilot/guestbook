<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 16.09.14
 * Time: 18:32
 */

namespace Steampilot\Util;
/**
 * Class Router
 *
 * This Class is responsible for directing and routing http request to the corresponding controller classes
 * @package Steampilot\Util
 */
class Router
{
	/**
	 * @var string The http request url
	 */
	protected $uri;

	/**
	 * @var string the name of the controller to be called
	 */
	protected $controller;

	/**
	 * @var string the name of the action to be called
	 */
	protected $action;

	/**
	 * @var array the get parameters that have to passed to the controller action function
	 */
	protected $params;

	/**
	 * Constructor
	 */
	public function __construct()
	{
		$this->uri = $_SERVER['REQUEST_URI'];
	}

	/**
	 * Runs the router
	 *
	 * @uses self::parseUri()
	 * @uses self::callControllerAction()
	 */
	public function run()
	{
		self::parseUri();
		self::callControllerAction();
	}

	/**
	 * Parses the uri
	 *
	 * It gets its data from the $_SERVER data. In order to determine in witch directory or in how many sub folders this
	 * application is installed $scriptNameCount counts the directory separators till it finds itself. This then will be
	 * fed back into the $parsedUri. With this method we can be certain the searched controller will be found.
	 *
	 * Also the request method POST or GET will be determined for convenient reasons
	 */
	protected function parseUri()
	{
		$scriptNameCount = count(explode('/', $_SERVER['SCRIPT_NAME'])) - 1;
		$parsedUri = array_slice(explode('/', parse_url($this->uri)['path']), $scriptNameCount);
		$controller = '\Controller\\' . ucfirst(strtolower($parsedUri[0])) . 'Controller';
		if ($controller === '\Controller\Controller') {
			$controller = '\Controller\PostController';
		} else if (!class_exists($controller)) {
			echo 'Controller <strong>' . $controller . '</strong> dos not exist';
			die;
		}
		$this->controller = $controller;
		if (!isset($parsedUri[1]) || $parsedUri[1] === '') {
			$this->action = 'index';
		} else {
			$this->action = $parsedUri[1];
		}
		$params = explode('&', (parse_url($this->uri, PHP_URL_QUERY) ? '&' : '') . http_build_query($_GET));
		foreach ($params as $pair) {
			if (isset(explode('=', $pair)[1])) {
				if (!empty(explode('=', $pair)[1])) {
					$this->params['GET'][explode('=', $pair)[0]] = explode('=', $pair)[1];
				}
			}
		}
		if (isset($_POST) || !empty($_POST)) {
			$this->params['POST'] = $_POST;
		} else {
			$this->params['POST'] = null;
		}
	}

	/**
	 * Calls a controller action
	 * Instantiates a object of an controller and calls upon its action.
	 * It uses the concept of variable variables.
	 */
	protected function callControllerAction()
	{
		$controller = new $this->controller($this->params);
		if (!method_exists($controller, $this->action) || (!is_callable(array($controller, $this->action)))) {
			echo "Page not found";
			exit;
		}
		$controller->{$this->action}();
	}
}
