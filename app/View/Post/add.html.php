<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */


$name = $user['name'];
$email = $user['email'];
$btnUrl = __BASE_URL__.'Post/index';
$btnText = 'Back to the List';
$submitUrl = __BASE_URL__.'Post/add';
$session_user_id = 2;
$today = date('Y-m-d h:m:s');
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
				<h3>Write a Post</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="created" name="created" value="<?php ph($today); ?>">
					<input type="hidden" name="is_published" value="false">
					<input type="hidden" id="user_id" name="user_id" value="1">
					<div class="form-group">
						<label for="subject">Subject</label>
						<input type="text" class="form-control" name="subject" id="subject" placeholder="Whats it all about">
					</div>
					<div class="form-group">
						<label for="message">Message</label>
						<textarea class="form-control" name="message" id="message " rows="3"></textarea>

					</div>
					<div class="form-inline">
						<button type="submit" class="btn btn-default">Submit</button>
						<div class="checkbox col-lg-offset-1">
							<label>
								<input type="checkbox" VALUE="true"  id="is_published" name="is_published">  Publish this Message
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="panel-footer">
				created Today
			</div>
		</div>
	</article>
</main>