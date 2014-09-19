<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;

class PostModel extends Model{

	public function __construct(){
	parent::__construct();
	}

	/**
	 * Get one distinct record of a table by its id
	 * @param $id
	 * @return mixed
	 */
	public function getOne($id) {
		$sql = "SELECT *
				FROM posts
				WHERE id = {$id};";
		$result = $this->db->query($sql);
		return $result[0];
	}

	/**
	 * gets all records of a table
	 * @return mixed
	 */
	public function getAll(){
		$sql = "SELECT * FROM posts;";
		$result = $this->db->query($sql);
		return $result;
	}

	public function save($id) {
		// TODO: Implement save() method.
	}

	public function delete($id) {
		// TODO: Implement delete() method.
	}
}