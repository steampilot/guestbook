<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 13:55
 */
if (isset($success)) {
	$title = $success['title'];
	$text = $success['text'];
} else {
	$title = 'SUCCESS';
	$text = 'No idea what you just did. Could be you wiped the internet. Anyhow, it worked!';
}
?>

<div class="container">
	<div class="panel panel-success">
		<div class="panel-body">
			<div class="alert alert-success" role="alert">
				<h3><?php ph($title); ?></h3>

				<p><?php ph($text); ?></p>
			</div>
		</div>
	</div>
</div>