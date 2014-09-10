<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 04.09.14
 * Time: 10:42
 */

require_once __DIR__.'/app/autoload.php';
echo(' <meta charset="UTF-8"> ');
/**
 * Aguirre the database object
 */
\Config::init();
$db = App::getDb();
var_dump($db);



/**
 * yield the content of the users table
 */
$sql = 'SELECT * FROM users;';
var_dump($sql);
$rows = $db->query($sql);
foreach ( $rows as $row) {
var_dump($row);
}

/**
 * yield the content of the posts table
 */
$sql = 'SELECT * FROM posts;';
$rows = $db->query($sql);
foreach ( $rows as $row) {
	var_dump($row);
}



