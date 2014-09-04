<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */
require_once __DIR__.'/app/autoload.php';


$db = App::getDb();
var_dump($db);

$sql = 'SELECT * FROM information_schema.columns;';
foreach ($db->query($sql) as $row) {
	var_dump($row);
}



