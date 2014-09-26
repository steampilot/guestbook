<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;

class PostModel extends Model {

	public function __construct() {
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
				FROM posts AS p
				LEFT OUTER JOIN users AS u ON p.users_id = u.id
				WHERE p.id = {$id};";
		$result = $db->query($sql);
		if (isset($result[0])) {
			return $result[0];
		} else {
			return null;
		}
	}

	/**
	 * gets all records of a table
	 * @return mixed
	 */
	public function getAll() {
		$db = $this->getDb();
		$sql = "SELECT *
				FROM posts AS p
				LEFT OUTER JOIN users AS u ON p.users_id = u.id;";
		$result = $db->query($sql);
		return $result;
	}
	public function beforeAdd(){
		$db = $this->getDb();
			$sql = "SELECT *
					FROM users
					WHERE id = 2;";
		$result = $db->query($sql);
		if(isset($result[0])){
			return$result[0];
		} else {
			return null;
		}
	}

	public function save($id) {
		// TODO: Implement save() method.
	}

	public function delete($id) {
		// TODO: Implement delete() method.
	}
}