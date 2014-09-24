<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;

class UserModel extends Model{

	public function __construct(){
	parent::__construct();
	}

	/**
	 * Get one distinct record of a table by its id
	 * @param $id
	 * @return mixed
	 */
	public function getOne($id) {
		$db = $this->getDb();
		$sql = "SELECT *
				FROM users
				WHERE id = {$id};";
		$result = $db->query($sql);
		return $result[0];
	}

	/**
	 * gets all records of a table
	 * @return mixed
	 */
	public function getAll(){
		$db = $this->getDb();
		$sql = "SELECT * FROM users;";
		$result = $db->query($sql);
		return $result;
	}

	public function save($id) {
		$db = $this->getDb();
		// TODO: Implement save() method.
	}

	public function delete($id) {
		$db = $this->getDb();
		// TODO: Implement delete() method.
	}
}