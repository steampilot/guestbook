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
class App
{
	/**
	 * Contains the database object
	 * @var \Steampilot\util\DbConnector
	 */
	protected static $db;
	/**
	 * Contains the Template Object to render the views
	 * @var \Steampilot\Util\Template
	 */
	protected static $tpl;

	/**
	 * Gets e singleton database object
	 *
	 * @return \Steampilot\Util\DbConnector The Database object
	 */
	public static function getDb()
	{
		if (isset(static::$db)) {
			return static::$db;
		} else {
			static::$db = new DbConnector();
			static::$db->connect(Config::get('db.hostname'), Config::get('db.database'),
				Config::get('db.username'), Config::get('db.password'));
			return static::$db;
		}
	}

	/**
	 * Gets a singleton template object
	 *
	 * @return \Steampilot\Util\Template The template object
	 */
	public static function getTpl()
	{
		if (isset(static::$tpl)) {
			return static::$tpl;
		} else {
			static::$tpl = new Template();
			return static::$tpl;
		}
	}
} 