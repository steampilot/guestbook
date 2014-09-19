<?php

/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 11:31
 */
use \Steampilot\Util\DbConnector;
use \Config\Config;
use Steampilot\Util\Template;

/**
 * Class App
 *
 * basic application class that holds the configuration and creates the database object
 */
class App {
	/**
	 * Contains the database object
	 * @var
	 */
	protected static $db;
	/**
	 * Contains the Template Object to render the views
	 * @var
	 */
	protected static $tpl;

	/**
	 * Gets the database object
	 *
	 * @return mixed The database object
	 */
	public static function getDb() {
		if (isset(static::$db)) {
			return static::$db;
		} else {
			static::$db = new DbConnector();
			static::$db->connect(Config::get('db.hostname'), Config::get('db.database'),
				Config::get('db.username'), Config::get('db.password'));
			return static::$db;
		}
	}
	public static function getTpl() {
		if (isset(static::$tpl)){
			return static::$tpl;
		} else {
			static::$tpl = new Template();
			static::$tpl->setLayoutFile(Config::get('app.layout'));
			static::$tpl->setViewVars('app', array('title'=> Config::get('app.name')));
			return static::$tpl;
		}
	}
} 