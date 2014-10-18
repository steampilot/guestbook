<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:39
 */

namespace Steampilot\Util;
/**
 * Class Template
 *
 * This class is responsible passing through the te data that will be displayed to the view and renders
 * it by including the view files.
 * @package Steampilot\Util
 */
class Template
{
	/**
	 * @var string the main view file
	 */
	protected $layoutFile;

	/**
	 * @var array The data to be displayed in a view
	 */
	protected $viewVars;

	/**
	 * sets the view variables
	 * @param $key
	 * @param $value
	 */
	public function setViewVars($key, $value)
	{
		$this->viewVars[$key] = $value;
	}

	/**
	 * Adds a view file
	 *
	 * It adds the path to te view file to be rendererd to the list.
	 * @param $path string The path to a view file.
	 * @see \Controlle\Controller
	 */
	public function addViewFile($path)
	{
		$this->viewVars['VIEW_FILES'][] = $path;
	}

	/**
	 * Adds a View Element to the list
	 *
	 * This is a simplifying function to add view elements that are common and conform to the viewVars
	 * @see \Controller\Controller
	 * @param $socket
	 * @param $widget
	 */
	public function addViewElement($socket, $widget)
	{
		$this->viewVars['VIEW_ELEMENT'][$socket] = $widget;
	}

	/**
	 * sets the layout for the application
	 * @param $layoutFile
	 */
	public function setLayout($layoutFile)
	{
		$this->layoutFile = $layoutFile;
	}

	/**
	 * Renders a view
	 *
	 * If the viewVars are filled, actually they are always filled, they will be
	 * extracted into different variable variables. last but not least the layoutFile wil be
	 * included witch in turn includes all the other viewFiles that are specified within the viewVars
	 */
	public function render()
	{
		if (!empty($this->viewVars)) {
			extract($this->viewVars, EXTR_REFS);
		}
		include $this->layoutFile;
	}

	/**
	 * Gets the the view vars for debugging reasons
	 * @return array
	 */
	public function getViewVars()
	{
		return $this->viewVars;
	}
}