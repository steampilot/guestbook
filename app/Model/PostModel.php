<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 11:58
 */

namespace Model;


class PostModel {
	public function getOne($id) {
		$db = \App::getDb();
		$sql = "SELECT *
				FROM posts
				WHERE id = {$id};";
		$result = $db->query($sql);
		return $result[0];
	}
	public function getAll(){
		$db = \App::getDb();
		$sql = "SELECT * FROM posts;";
		$result = $db->query($sql);
		return $result;
	}
} 