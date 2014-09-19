<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */
require_once __DIR__.'/app/autoload.php';
require_once __DIR__.'/app/Steampilot/Util/htmlHelper.php';

\Config\Config::init();

use Steampilot\Util\Debug;
use \Steampilot\Util\Route;

session_name('SPGB-Guestbook');

@session_start();
//$index = new \Controller\IndexController();

new Route($_SERVER['REQUEST_URI']);
//$index->index();
Debug::dump($_SERVER);