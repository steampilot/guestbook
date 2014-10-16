<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;

class UserModel extends Model {

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
		$sql = 'SELECT id, name, email, role FROM user WHERE id = {id};';
		$fields = array(
			'id'=> $id
		);
		$sql = prepare($sql, $fields);
		$result = $db->query($sql);
		if (isset($result[0])) {
			$result[0]['roleName'] = $this->getRoleName($result[0]['role']);
			var_dump($result);
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
		$sql =
		$sql = 'SELECT
					id,
					name,
					email,
					role
				FROM user;';
		$result = $db->query($sql);
		foreach ($result as $row){
			$row['roleName'] = $this->getRoleName($row['role']);
			$newResult[] = $row;
		}

		var_dump($newResult);
		return $newResult;
	}
	protected function getRoleName($role){
		switch ($role){
			case 1:
				return 'Administrator';
			case 2:
				return 'Author';
			case 3:
				return 'Guest';
		}
	}

	public function create($fields){
		$db = $this->getDb();
		$fields['password'] = password_hash($fields['password'],PASSWORD_DEFAULT);
		$sql = 'INSERT INTO user (name, email, role, password)
				VALUES ({name}, {email}, {role}, {password});';
		$sql = prepare($sql, $fields, true);
		return $db->exec($sql);
	}

	public function update($fields) {
		$db = $this->getDb();
				$sql = 'UPDATE user SET
				name = {name},
				email = {email},
				role = {role}
				password = {password}
				WHERE id = {id};';
		$fields['password'] = password_hash($fields['password'],PASSWORD_DEFAULT);
		$sql = prepare($sql,$fields);
		return $db->exec($sql);
	}

	public function delete($id) {
		//
		$db = $this->getDb();
		$sql = 'DELETE FROM user WHERE id = {id};';
		$fields = array(
			'id' => $id
		);
		$sql = prepare($sql,$fields);
		return $db->exec($sql);
	}

	/**
	 * Checks if the password is equal to the saved password hash
	 *
	 * @param $id
	 * @param $password
	 * @return bool Returns true if the password equals the hash
	 */
	public function checkPassword($id, $password){
		$db = $this->getDb();
		$sql = 'SELECT password FROM user WHERE id = {id};';
		$fields = array(
			'id' => $id
		);
		$sql = prepare($sql, $fields);
		$result = $db->query($sql);
		return password_verify($password,$result);
	}
	public function setPassword($id,$password){
		$db = $this->getDb();
		$password = password_hash($password,PASSWORD_DEFAULT);
		$sql = $sql = 'UPDATE user SET
				password = {password}
				WHERE id = {id};';
		$fields = array(
			'id' => $id,
			'password' => $password
		);
		$sql = prepare($sql,$fields);
		return $db->exec($sql);
	}
	public function validate($data){
	}

}
