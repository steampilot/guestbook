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
		$sql = 'SELECT
					p.id,
					p.subject,
					p.message,
					p.created,
					p.modified,
					p.published,
					p.author_id,
					u.name 	AS author_name,
					u.email AS author_email
				FROM post AS p
				LEFT JOIN user AS u ON p.author_id = u.id
				WHERE p.id = {id};';
		$fields = array(
			'id'=> $id
		)
		;
		$sql = prepare($sql, $fields);
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
		$sql =
		$sql = 'SELECT
					p.id,
					p.subject,
					p.message,
					p.published,
					p.created,
					p.modified,
					p.author_id,
					u.name as author_name,
					u.email as author_email
				FROM post AS p
				LEFT JOIN user AS u ON p.author_id = u.id;';
		$result = $db->query($sql);
		return $result;
	}

	/**
	 * Gets the user alias author of a post
	 * @param int $id The author id
	 * @return null|array the author
	 */
	public function getAuthor($id){
		$db = $this->getDb();
		$fields = array(
			'id' => $id
		);
		$sql = 'SELECT id, name, email
				FROM user
				WHERE id = {id};';
		$sql = prepare($sql, $fields, false);
		var_dump($sql);
		$result = $db->query($sql);
		if(isset($result[0])){
			return$result[0];
		} else {
			return null;
		}
	}
	public function create($fields){
		$db = $this->getDb();
		$sql = 'INSERT INTO post (author_id, subject, message, published, created)
				VALUES ({author_id}, {subject}, {message}, {published}, {created});';
		$sql = prepare($sql, $fields, true);
		var_dump($sql);
		$result = $db->exec($sql);
		return $result;
	}

	public function update($fields) {
		$db = $this->getDb();
				$sql = 'UPDATE post SET
				subject = {subject},
				message = {message},
				published = {published},
				modified = {modified}
				WHERE id = {id};';
		$sql = prepare($sql,$fields);
		var_dump($sql);

		$result = $db->exec($sql);
		return $result;
	}

	public function delete($id) {
		//
	}
}