<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 11:23
 */

/**
 * Class auto loader
 *
 * register extended PSR0 auto loader
 * @see https://github.com/odan/molengo
 */
//
spl_autoload_register(function ($strClassName) {
	$strClassName = ltrim($strClassName, '\\');
	$strFileName = '';
	$strNamespace = '';
	$numLastNsPos = strripos($strClassName, '\\');
	if ($numLastNsPos !== false) {
		$strNamespace = substr($strClassName, 0, $numLastNsPos);
		$strClassName = substr($strClassName, $numLastNsPos + 1);
		$strFileName = str_replace('\\', DIRECTORY_SEPARATOR, $strNamespace) . DIRECTORY_SEPARATOR;
	}
	//$strFileName .= str_replace('_', DIRECTORY_SEPARATOR, $strClassName) . '.php';
	$strFileName = __DIR__ . '/' . $strFileName . str_replace('_', DIRECTORY_SEPARATOR, $strClassName) . '.php';
	if (file_exists($strFileName)) {
		require_once $strFileName;
		return true;
	}
	return false;
});

