<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 15:43
 */


$session_user_id = 2;
$today = $app['today'];
$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
$id = $post['id'];
$author_id = $post['author_id'];
$author_name = $post['author_name'];
$author_email = $post['author_email'];
$subject = $post ['subject'];
$message = $post ['message'];
$published = $post ['published'];
$created = $post['created'];
$modified = $today;
$submitUrl = __BASE_URL__ . 'Post/edit?id=' . $id;
?>

<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<small>
			Created by:
		</small>
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
				<h3>Edit your post</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" name="id" value="<?php ph($id); ?>">
					<input type="hidden" name="author_id" value="<?php ph($author_id); ?>">
					<input type="hidden" name="published" value="<?php ph($published); ?>">
					<input type="hidden" name="created" value="<?php ph($created); ?>">
					<input type="hidden" name="modified" value="<?php ph($modified); ?>">

					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" class="form-control" name="subject" id="subject"
						       value="<?php ph($subject); ?>">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" name="message" id="message "
						          rows="3"><?php ph($message); ?></textarea>

					</div>
					<div class="form-inline">
						<button type="submit" class="btn btn-default">Submit</button>
						<div class="checkbox col-lg-offset-1">
							<label>
								<input type="checkbox" VALUE="true" id="is_published" name="is_published"> Message
								is published
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-4">
						<small><strong>Created:</strong><?php ph($created); ?></small>
					</div>
					<div class="col-sm-4">
						<small><strong>Modified:</strong><?php ph('Today'); ?></small>
					</div>
				</div>
			</div>
		</div>
	</article>
</main>