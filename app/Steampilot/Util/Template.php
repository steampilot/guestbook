<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;

class Template {

	protected $viewFiles = array();
	protected $viewVars;

	public function __construct(){
	}
	public function setViewVars($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function addViewFile($path) {
		$this->viewVars['VIEW_FILES'][] = $path;
	}
	public function setLayoutFile($path) {
		$this->viewVars['LAYOUT'] = $path;
	}
	public function render(){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		include $this->viewVars['LAYOUT'];

	}
}