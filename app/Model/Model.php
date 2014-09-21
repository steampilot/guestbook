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
	public function __construct() {
		$this->db = \App::getDb();
	}
	public abstract function getOne($id);
	public abstract function getAll();
	public abstract function save($id);
	public abstract function delete($id);
}