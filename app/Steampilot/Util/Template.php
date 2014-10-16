<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;

class Template {
	protected $layoutFile;
	protected $viewVars;

	public function setViewVars($key, $value){
		$this->viewVars[$key] = $value;
	}
	public function addViewFile($path) {
		$this->viewVars['VIEW_FILES'][] = $path;
	}
	public function addViewElement($socket, $widget){
		$this->viewVars['VIEW_ELEMENT'][$socket] = $widget;
	}
	public function setLayout($layoutFile){
		$this->layoutFile = $layoutFile;
	}
	public function render(){
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		include $this->layoutFile;
	}
	public function getViewVars(){
		return $this->viewVars;
	}
}