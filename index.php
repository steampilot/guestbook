<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */

require_once __DIR__.'/app/Config/config.php';
require_once __DIR__.'/app/Steampilot/Util/Debug.php';
use \Steampilot\Util\Route;
use \Steampilot\Util\Debug;
session_name('SPGB-Guestbook');
@session_start();
//$index = new \Controller\IndexController();
$controller = new Route($_SERVER['REQUEST_URI']);
//$index->index();
//var_dump($controller);
