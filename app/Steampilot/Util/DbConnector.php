<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 09:45
 */

namespace Steampilot\Util;

use PDO;

/**
 * Class DbConnector
 *
 * PDO database connection handler class
 * @package Steampilot\Util
 */
class DbConnector
{

	/**
	 * Contains the PDO database connection
	 *
	 * @var null|\PDO
	 */
	protected $dbConnection = null;
	/**
	 * Contains the number of rows that are affected after a successful sql execution
	 * @var int
	 */
	protected $affectedRows = 0;

	/**
	 * Opens the connection to the database via \PDO
	 *
	 * @param string $hostname The database host name defaults to 'localhost'
	 * @param string $database The database name defaults to standard test database
	 * @param string $username The database user name defaults to root
	 * @param string $password the database user password defaults to empty
	 * @return void
	 */
	public function connect($hostname = '127.0.0.1', $database = 'test', $username = 'root', $password = '')
	{

		// open the database connection
		$this->dbConnection = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);

		// enable exceptions
		$this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

		// convert nulls to empty string
		$this->dbConnection->setAttribute(PDO::ATTR_ORACLE_NULLS, PDO::NULL_TO_STRING);

		// convert column names to lower case.
		$this->dbConnection->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);

		// enable the use of utf8
		$this->dbConnection->exec("set names utf8");
	}

	/**
	 * Closes the database connection
	 *
	 * @return void
	 */
	protected function disconnect()
	{
		unset ($this->dbConnection);
	}

	/**
	 * Performs an SQL query
	 *
	 * The result will be fetched as associated array
	 * @param $sql string The SQL string to be executed
	 * @return array The fetched data result
	 * @throws \Exception
	 */
	public function query($sql)
	{

		$statement = $this->dbConnection->query($sql);
		if (!$statement) {
			throw new \Exception('Invalid database query');
		}
		$result = $statement->fetchAll(PDO::FETCH_ASSOC);
		return $result;
	}

	/**
	 * Executes a SQL statement
	 * @param $sql string The SQL string to be executed
	 * @return bool|int Return the number of rows affected by this statement
	 */
	public function exec($sql)
	{
		if ($sql === '' || $sql === null) {
			return false;
		}

		$affectedRows = $this->dbConnection->exec($sql);
		return $affectedRows;
	}

	/**
	 * Quotes and escapes a SQL conform string
	 *
	 * @param $string string The SQL statement to be passed
	 * @return string The Quoted and escaped save to use string.
	 */
	public function quote($string)
	{
		$escaped = $this->dbConnection->quote($string, PDO::PARAM_STR);
		return $escaped;
	}

	/**
	 * Prepares a SQL statement
	 * @param $sql string The SQL statement to be processed
	 * @param array $fields The data to be filled into the corresponding placeholders
	 * @param bool $escaping
	 * @return string
	 */
	public function prepare($sql, array $fields = array(), $escaping = true)
	{
		$replace = array();
		foreach ($fields as $key => $value) {
			if ($escaping) {
				$replace['{' . $key . '}'] = $this->quote($value);
			} else {
				$replace['{' . $key . '}'] = $value;
			}
		}
		//swaps the placeholders with the fields
		return strtr($sql, $replace);
	}

}