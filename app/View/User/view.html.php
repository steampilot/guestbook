<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */

$name = $user['name']; // The headline or Subject of the post
$email = $user['email']; // The message of that post
$created = $user['created']; // The date time of creation
$modified = $user['modified']; //The date time of the last modification

$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
?>
<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<h1>
			<?php ph($name); ?>
		</h1>

		<p>
			<?php ph($email); ?>
		</p>

		<p>
			<a href="<?php pu($btnUrl); ?>" class="btn btn-primary btn-lg"
			   role="button"><?php ph($btnText); ?> &raquo;</a>
		</p>
	</header>
	<article id='postView' class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<div class="inline">
					<h1>
						<?php ph('some other info'); ?>
					</h1>
				</div>


			</div>
			<div class="panel-body">
				<?php ph('Some more info'); ?>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-4">
						<small><strong>Created:</strong><?php ph($created); ?></small>
					</div>
					<div class="col-sm-4">
						<small><strong>Modified:</strong><?php ph($modified); ?></small>
					</div>
				</div>
			</div>
	</article>
</main>