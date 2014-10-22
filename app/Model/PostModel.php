<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;
/**
 * Class PostModel
 *
 * Handling the database SQL Requests specific for the te data regarding the guest book posts.
 * As the Strict convention between controller and model, the model is responsible for
 * acquiring data from different tables in order to satisfy the controllers needs.
 * @package Model
 */
class PostModel extends Model
{
	/**
	 * The Constructor
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
			'id' => $id
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
	 * gets all records of a table
	 * @return mixed
	 */
	public function getAll()
	{
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
				LEFT JOIN user AS u ON p.author_id = u.id
				ORDER BY p.id DESC;';
		$result = $db->query($sql);
		foreach ($result as $id => $post) {
			if (strlen($post['message']) > 60) {
				$result[$id]['message'] = substr($post['message'], 0, 60) . '\n ... Read more';
			}

		}
		return $result;
	}

	/**
	 * Gets the user alias author of a post
	 * @param int $id The author id
	 * @return null|array the author
	 */
	public function getAuthor($id)
	{
		$db = $this->getDb();
		$fields = array(
			'id' => $id
		);
		$sql = 'SELECT id, name, email
				FROM user
				WHERE id = {id};';
		$sql = $db->prepare($sql, $fields, false);
		$result = $db->query($sql);
		if (isset($result[0])) {
			return $result[0];
		} else {
			return null;
		}
	}

	/**
	 * Inserts a new guest book post
	 *
	 * @param array $fields
	 * @return bool|int|mixed
	 */
	public function create($fields)
	{
		$db = $this->getDb();
		$sql = 'INSERT INTO post (author_id, subject, message, published, created)
				VALUES ({author_id}, {subject}, {message}, {published}, {created});';
		$sql = $db->prepare($sql, $fields, true);
		return $db->exec($sql);
	}

	/**
	 * Updates a guest book post
	 * @param array $fields
	 * @return bool|int|mixed
	 */
	public function update($fields)
	{
		$db = $this->getDb();
		$sql = 'UPDATE post SET
				subject = {subject},
				message = {message},
				published = {published},
				modified = {modified}
				WHERE id = {id};';
		$sql = $db->prepare($sql, $fields);
		return $db->exec($sql);
	}

	/**
	 * Deletes a guest book post
	 * @param int $id
	 * @return bool|int|mixed
	 */
	public function delete($id)
	{
		//
		$db = $this->getDb();
		$sql = 'DELETE FROM post WHERE id = {id};';
		$fields = array(
			'id' => $id
		);
		$sql = $db->prepare($sql, $fields);
		return $db->exec($sql);
	}

	public function validate($data)
	{
	}
}
