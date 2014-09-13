<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 11.09.14
 * Time: 12:14
 */

namespace Controller;

class IndexController {
	public function index() {
		$index = new PostController();
		$index->index();
	}
} 