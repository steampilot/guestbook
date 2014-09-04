<?php

/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 11:31
 */

class App {
	public static $dbHostname = '127.0.0.1';
	public static $dbDatabase = 'spgb';
	public static $dbUsername = 'root';
	public static $dbPassword = '';

	protected static $db;

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