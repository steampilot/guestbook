<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */

$subject = $post['subject'];
$message = $post['message'];
$created = $post['created'];
$name = $post['name'];
$email = $post['email'];

$btnUrl = __BASE_URL__.'Post/index';
$btnText = 'Back to the List';
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<main class="container">
<header class="jumbo-narrow col-lg-4">
	<h1>
		<?php ph($name); ?>
	</h1>
	<p>
		<?php ph($email); ?>
	</p>
	<p>
		<a href="<?php pu($btnUrl);?>" class="btn btn-primary btn-lg" role="button"><?php ph($btnText);?> &raquo;</a>
	</p>
</header>
<article id='postView' class="col-lg-8">
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