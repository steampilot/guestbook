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
use Steampilot\Util\Router;
session_name('SPGB-Guestbook');

@session_start();
//$index = new \Controller\IndexController();

$router = new Router();
$router->run();