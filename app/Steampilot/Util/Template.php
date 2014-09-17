<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;
use Config\Config;

class Template {
	protected $htmlHeader;
	protected $htmlFooter;

	protected $viewElements = array();
	protected $viewVars;

	public function __construct(){
	}
	public function setViewVars($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function addViewElement($path) {
		$this->viewVars['VIEW_FILES'][] = $path;
	}
	public function render(){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}

		include Config::get('layout');

	}
}