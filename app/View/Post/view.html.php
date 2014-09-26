<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */

//$name = $user['name'];
//$email = $user['email'];
//$created = $user['created'];
$subject = $post['subject'];
$message = $post['message'];
$created = $post['created'];
$name = $post['name'];
$email = $post['email'];
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<main class="container">
<header class="jumbotron-narrow col-lg-4">
	<h1>
		<?php ph($name); ?>
	</h1>
	<p>
		<?php ph($email); ?>
	</p>
</header>

<article class="col-lg-8">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php ph($subject); ?>
		</div>
		<div class="panel-body">
			<?php ph($message); ?>
		</div>
		<div class="panel-footer">
			<?php ph($created); ?>
		</div>
	</article>
</main>