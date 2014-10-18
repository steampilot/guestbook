<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 13:55
 */
if (isset($error)) {
	$title = $error['title'];
	$text = $error['text'];
} else {
	$title = 'ERROR';
	$text = 'Brace yourselves the end is near!';
}
?>

<div class="container">
	<div class="panel panel-danger">
		<div class="panel-body">
			<div class="alert alert-danger" role="alert">
				<h3><?php ph($title); ?></h3>

				<p><?php ph($text); ?></p>
			</div>
		</div>
	</div>
</div>