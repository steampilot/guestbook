<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;
/**
 * Class UserModel
 *
 * Handling the database SQL Requests specific for the te data regarding the users of the guest book.
 * As the Strict convention between controller and model, the model is responsible for
 * acquiring data from different tables in order to satisfy the controllers needs.
 * @package Model
 */
class UserModel extends Model
{
	/**
	 * Constructor
 	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get one distinct record of a table by its id
	 * @param $id
	 * @return mixed
	 */
	public function getOne($id)
	{
		$db = $this->getDb();
		$sql = 'SELECT id, name, email, role , created, modified FROM user WHERE id = {id};';
		$fields = array(
			'id' => $id
		);
		$sql = $db->prepare($sql, $fields);
		$result = $db->query($sql);
		if (isset($result[0])) {
			$result[0]['roleName'] = $this->getRoleName($result[0]['role']);
			return $result[0];
		} else {
			return null;
		}
	}

	/**
	 * Gets all records of a table
	 * @return mixed
	 */
	public function getAll()
	{
		$db = $this->getDb();
		$sql =
		$sql = 'SELECT
					id,
					name,
					email,
					role
				FROM user;';
		$result = $db->query($sql);
		/**
		 * Get the role name by calling the lookup function and push it back into the result
		 */
		$newResult = array();
		foreach ($result as $row) {
			$row['roleName'] = $this->getRoleName($row['role']);
			$newResult[] = $row;
		}
		return $newResult;
	}

	/**
	 * Gets the name of the role of a user
	 * @param $role
	 * @return string
	 */
	protected function getRoleName($role)
	{
		$name = '';
		switch ($role) {
			case 1:
				$name = 'Administrator';
				break;
			case 2:
				$name = 'Author';
				break;
			case 3:
				$name = 'Guest';
				break;
		}
		return $name;
	}

	/**
	 * Get one user by its email
	 *
	 * This is particularly helpful after creating a new user and its id is not known at this point because of the
	 * auto incrementation by the database
	 * @param $email
	 * @return null
	 */
	public function getOneByEmail($email)
	{
		$db = $this->getDb();
		$sql = 'SELECT id, name, email, password FROM user WHERE email = {email};';
		$fields = array(
			'email' => $email
		);
		$sql = $db->prepare($sql, $fields);
		$result = $db->query($sql);
		if (isset($result[0])) {
			return $result[0];
		} else {
			return null;
		}
	}

	/**
	 * Inserts a new user into the database
	 *
	 * It hashes the password by using the standard PHP password hash function. Important Note: Make sure the collumn
	 * has at least varchar(255) allocated
	 * @param array $fields
	 * @return bool|int|mixed
	 */
	public function create($fields)
	{
		$db = $this->getDb();
		$hash = create_password_hash($fields['password'], PASSWORD_DEFAULT);
		$fields['password'] = $hash;
		$sql = 'INSERT INTO user (name, email, role, password, created)
				VALUES ({name}, {email}, {role}, {password}, {created});';
		$sql = $db->prepare($sql, $fields, true);
		return $db->exec($sql);
	}

	/**
	 * Updates a users password
	 *
	 * @param array $fields
	 * @return bool|int|mixed
	 */
	public function update($fields)
	{
		$db = $this->getDb();
		$sql = 'UPDATE user SET
				password = {password}
				modified = {modified},
				WHERE id = {id};';
		$hash = create_password_hash($fields['password'], PASSWORD_DEFAULT);
		$fields['password'] = $hash;
		$sql = $db->prepare($sql, $fields);
		return $db->exec($sql);
	}

	/**
	 * Deletes a guest book user. Important notice: Because of Foreignkey behavior 'on delete cascade'
	 * within the database all its posts wil be deleted as well.
	 * @param int $id
	 * @return bool|int|mixed
	 */
	public function delete($id)
	{
		//
		$db = $this->getDb();
		$sql = 'DELETE FROM user WHERE id = {id};';
		$fields = array(
			'id' => $id
		);
		$sql = $db->prepare($sql, $fields);
		return $db->exec($sql);
	}

	/**
	 * Checks if the password is equal to the saved password hash
	 *
	 * @param $id
	 * @param $password
	 * @return bool Returns true if the password equals the hash
	 */
	public function checkPassword($id, $password)
	{
		$db = $this->getDb();
		$sql = 'SELECT password FROM user WHERE id = {id};';
		$fields = array(
			'id' => $id
	);
		$sql = $db->prepare($sql, $fields);
		$result = $db->query($sql);
		return verify_password_hash($password, $result[0]['password']);
	}

	/**
	 * Sets a password for a guest book user.
	 *
	 * @param $id
	 * @param $password
	 * @return bool|int
	 */
	public function setPassword($id, $password)
	{
		$db = $this->getDb();
		$password = $thist->password_hash($password, PASSWORD_DEFAULT);
		$sql = $sql = 'UPDATE user SET
				password = {password}
				modified = {modified}
				WHERE id = {id};';
		$fields = array(
			'id' => $id,
			'password' => $password
		);
		$sql = $db->prepare($sql, $fields);
		return $db->exec($sql);
	}

	public function validate($data)
	{
	}

}
