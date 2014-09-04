<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */
require_once __DIR__.'/app/autoload.php';

/**
 * Aguirre the database object
 */
$db = App::getDb();
var_dump($db);

/**
 * yield the content of the users table
 */
$sql = 'SELECT * FROM spgb.users;';
foreach ($db->query($sql) as $row) {
	var_dump($row);
}

/**
 * yield the content of the posts table
 */
$sql = 'SELECT * FROM spgb.posts;';
foreach ($db->query($sql) as $row) {
 var_dump($row);
}



