<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:50
 */

namespace Controller;

use Model\UserModel;


class UserController extends Controller {

	public function __construct() {
		$this->model = new UserModel();
		parent::__construct($model);
	}

	public function index() {
		// TODO: Implement index() method.
	}

	public function view() {
		// TODO: Implement view() method.
	}

	public function add() {
		// TODO: Implement add() method.
	}

	public function edit() {
		// TODO: Implement edit() method.
	}

	public function delete() {
		// TODO: Implement delete() method.
	}
}