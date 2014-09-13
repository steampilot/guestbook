<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;
use Steampilot\Util\Debug;


class Template {
	protected $viewVars;
	public function set($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function render($fileName){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		Debug::dump($this->viewVars, 'View variables Should be like this');
		include $fileName;
	}
}