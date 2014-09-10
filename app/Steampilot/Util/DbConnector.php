<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 09:45
 */

namespace Steampilot\Util;

/**
 * Class DbConnector
 *
 * PDO database connection handler class
 * @package Steampilot\Util
 */
class DbConnector {

	/**
	 * Contains the PDO database connection
	 *
	 * @var null|\PDO
	 */
	protected $dbConnection = null;

	/**
	 * Opens the connection to the database via \PDO
	 *
	 * @param string $hostname The database host name defaults to 'localhost'
	 * @param string $database The database name defaults to standard test database
	 * @param string $username The database user name defaults to root
	 * @param string $password the database user password defaults to empty
	 * @return void
	 */
	public function connect($hostname = '127.0.0.1', $database = 'test', $username = 'root', $password = '') {
		$this->dbConnection = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);
		$this->dbConnection->exec("set names utf8");
	}

	/**
	 * Closes the database connection
	 *
	 * @return void
	 */
	protected function disconnect() {
		unset ($this->dbConnection);
	}

	/**
	 * Executes sql query and fetches the result as associative array
	 *
	 * @param $sql String The Sql query to be executed
	 * @return array The fetch result
	 */
	public function query($sql) {

		$statement = $this->dbConnection->prepare($sql);
		$statement->execute();

		$result = $statement->fetchAll(\PDO::FETCH_ASSOC);

		return $result;
	}

	/**
	 * Escapes malicous code bla bla
	 *
	 */
	public function esc(){
		// escaping todoo
	}
}