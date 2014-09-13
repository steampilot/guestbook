<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */

require_once __DIR__.'/app/Config/config.php';

$index = new Controller\IndexController();
?>

<?php
$index->index();
?>