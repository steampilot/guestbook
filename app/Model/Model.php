<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 19.09.14
 * Time: 21:07
 */

namespace Model;


abstract class Model{
	protected $db;
	public function __construct($db = null) {
		if($db === null) {
			$this->db = \App::getDb();
		} else {
			$this->db = $db;
		}
	}

	/**
	 * gets the gets the database object
	 *
	 * @return null| \Steampilot\Util\DbConnector The Database Object
	 */
	public function getDb(){
		return $this->db;
	}
	public abstract function getOne($id);
	public abstract function getAll();
	public abstract function create($data);
	public abstract function update($data);
	public abstract function delete($id);
}