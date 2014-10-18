<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */

$subject = $post['subject']; // The headline or Subject of the post
$message = $post['message']; // The message of that post
$created = $post['created']; // The date time of creation
$modified = $post['modified']; //The date time of the last modification
$author_name = $post['author_name']; // The name of the Author
$author_email = $post['author_email']; // the Email of the Author

$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
$editUrl = __BASE_URL__ . 'Post/edit?id=' . $post['id'];
$deleteUrl = __BASE_URL__ . 'Post/delete?id=' . $post['id'];
?>
<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<h1>
			<?php ph($author_name); ?>
		</h1>

		<p>
			<?php ph($author_email); ?>
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
						<?php ph($subject); ?>
					</h1>
				</div>


			</div>
			<div class="panel-body">
				<?php ph($message); ?>
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