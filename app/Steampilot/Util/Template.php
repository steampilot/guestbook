<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;


class Template {
	protected $viewVars;
	public function set($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function render($fileName){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		if (\Config\Config::get('debug.mode')) {
			var_dump($this->viewVars);
		}
		include $fileName;
	}
}