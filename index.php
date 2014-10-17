<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */
require_once __DIR__.'/app/autoload.php';
require_once __DIR__ . '/app/Steampilot/Util/toolbox.php';

\Config\Config::init();

use Steampilot\Util\Debug;
use Steampilot\Util\Router;


$router = new Router();
$router->run();