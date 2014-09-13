<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 13.09.14
 * Time: 18:14
 */

namespace Steampilot\Util;
use Config\Config;

class Debug {
	public static function dump($object = null, $message='') {
		if (Config::get('debug.mode')) {var_dump($object);}
	}
}