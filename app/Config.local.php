<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 10.09.14
 * Time: 11:10
 */

/**
 * Class Config
 * 
 * This file is intended as Template. To install the guest book you must rename Config.php.local to Config.php
 */
class Config {
	/**
	 * Holds the settings
	 * @var array
	 */
	protected static $config = array();

	/**
	 * Sets the local database configuration
	 */
	protected static function setLocalConfig() {
		static::$config['db.hostname'] = '127.0.0.1';
		static::$config['db.database'] = 'spgb';
		static::$config['db.username'] = 'root';
		static::$config['db.password'] = '';
	}

	/**
	 * Sets the remote database configuration
	 */
	protected static function setRemoteConfig() {

		static::$config['db.hostname'] = '';
		static::$config['db.database'] = '';
		static::$config['db.username'] = '';
		static::$config['db.password'] = '';
	}

	/**
	 * Gets the specific config setting
	 * 
	 * @param $key
	 * @return mixed
	 */
	public static function get($key){
		return static::$config[$key];
	}

	/**
	 * Initialize the config based on location
	 */
	public  static function init(){
		if (($_SERVER['HTTP_HOST'] == '127.0.0.1') || ($_SERVER['HTTP_HOST'] == 'localhost')) {
			static::setLocalConfig();
		} else {
			static::setRemoteConfig();
		}
	}
} 