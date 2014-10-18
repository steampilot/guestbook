<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */


$session_user_id = 2;
$today = $app['today'];
$authorId = $author['id'];
$authorName = $author['name'];
$authorEmail = $author['email'];
$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
$submitUrl = __BASE_URL__ . 'Post/add';
?>
<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<h1>
			<?php ph($authorName); ?>
		</h1>

		<p>
			<?php ph($authorEmail); ?>
		</p>

		<p>
			<a href="<?php pu($btnUrl); ?>" class="btn btn-primary btn-lg"
			   role="button"><?php ph($btnText); ?> &raquo;</a>
		</p>
	</header>
	<article id='postView' class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Write a Post</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="created" name="created" value="<?php ph($today); ?>">
					<input type="hidden" name="published" value="false">
					<input type="hidden" id="author_id" name="author_id" value="<?php ph($authorId); ?>">

					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" class="form-control" name="subject" id="subject"
						       placeholder="Whats it all about">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" name="message" id="message " rows="3"></textarea>

					</div>
					<div class="form-inline">
						<button type="submit" class="btn btn-default">Submit</button>
						<div class="checkbox col-lg-offset-1">
							<label>
								<input type="checkbox" VALUE="true" id="is_published" name="published"> Publish this
								Message
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-4">
						<small><strong>Created:</strong><?php ph('Today'); ?></small>
					</div>
					<div class="col-sm-4">
						<small><strong>Modified:</strong><?php ph('Today'); ?></small>
					</div>
				</div>
			</div>
		</div>
	</article>
</main>