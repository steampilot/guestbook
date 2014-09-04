<?php

/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 11:31
 */

/**
 * Class App
 *
 * basic application class that holds the configuration and creates the database object
 */
class App {
	/**
	 * The name of the database Host
	 * @var string
	 */
	public static $dbHostname = '127.0.0.1';
	/**
	 * The name of the schema
	 * @var string
	 */
	public static $dbDatabase = 'spgb';
	/**
	 * The name of the database user
	 * @var string
	 */
	public static $dbUsername = 'root';
	/**
	 * The database user password
	 * @var string
	 */
	public static $dbPassword = '';
	/**
	 * Contains the database object
	 * @var
	 */
	protected static $db;

	/**
	 * Gets the database object
	 *
	 * @return mixed The database object
	 */
	public static function getDb() {
		if (isset(static::$db)) {
			return static::$db;
		} else {
			static::$db = new \Steampilot\Util\DbConnector();
			static::$db->connect(static::$dbHostname, static::$dbDatabase, static::$dbUsername, static::$dbPassword);
			return static::$db;
		}
	}
} 