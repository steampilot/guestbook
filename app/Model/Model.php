<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 19.09.14
 * Time: 21:07
 */

namespace Model;

/**
 * Class Model
 *
 * All models derive from this class are meant to interact with MySql. Therefore MySql syntax is used
 * @package Model
 */
abstract class Model
{
	/**
	 * @var null|\Steampilot\Util\DbConnector The Database object
	 */
	protected $db;

	/**
	 * @param null $db The Constructor
	 */
	public function __construct($db = null)
	{
		if ($db === null) {
			$this->db = \App::getDb();
		} else {
			$this->db = $db;
		}
	}

	/**
	 * Gets the database object
	 *
	 * @return null| \Steampilot\Util\DbConnector The Database Object
	 */
	public function getDb()
	{
		return $this->db;
	}

	/**
	 * Gets one record
	 *
	 * @param $id
	 * @return mixed|Array The Data of one record of a table by its id
	 */
	public abstract function getOne($id);

	/**
	 * @return mixed|Array The Data of all the records of a table
	 */
	public abstract function getAll();

	/**
	 * Inserts a new record into a table
	 *
	 * Id should never be given. The database handles the auto incrementation
	 * If the insert was successful the number of affected rows should always be greater than Zero
	 * @param $data array The fields to be inserted within this record
	 * @return mixed|integer The number of affected rows
	 */
	public abstract function create($data);

	/**
	 * Updates a record in a table
	 *
	 * The identifying id will be passed on within the data array
	 * If the update was successful the number of affected rows should always be greater than zero
	 * @param $data array the fields to be updated within this record
	 * @return mixed
	 */
	public abstract function update($data);

	/**
	 * Deletes a record identified by its id
	 * @param $id integer Thi Id of the record to be deleted
	 * If the deletion was successful the number of affected rows should always be greater than zero
	 * @return mixed|integer The number of affected rows
	 */
	public abstract function delete($id);
}