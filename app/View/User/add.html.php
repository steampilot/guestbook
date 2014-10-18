<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */


$session_user_id = 2;
$today = $app['today'];
$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
$submitUrl = __BASE_URL__ . 'User/add';
$name = '';
$email = '';
$alert = false;
if (isset($_POST) && !empty($_POST)) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$alert = true;
}
?>
<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<h1>
			Create New User
		</h1>

		<p>
			You will be able to write to this message board.
		</p>

		<p>
			<a href="<?php pu($btnUrl); ?>" class="btn btn-primary btn-lg"
			   role="button"><?php ph($btnText); ?> &raquo;</a>
		</p>
	</header>
	<article id='postView' class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Your account settings</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="created" name="created" value="<?php ph($today); ?>">
					<input type="hidden" name="role" value="3">

					<div class="form-group">
						<label for="subject">Name</label>
						<input type="text" class="form-control"
						       name="name" id="name"
						       value="<?php ph($name); ?>"
						       placeholder="Your Name">
					</div>
					<div class="form-group">
						<label for="subject">Email</label>
						<input type="email" class="form-control"
						       name="email" id="email"
						       value="<?php ph($email); ?>"
						       placeholder="you@email.com">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" size="32">
					</div>
					<div class="form-group">
						<label for="password-check">Retype Password</label>
						<input class="form-control" type="password" name="password-check" id="password-check" size="32">
					</div>
					<button type="submit" id='submit' class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="panel-footer">
				<div class="row">
					<div class="col-sm-4">
						<small><strong>Created:</strong><?php ph($today); ?></small>
					</div>
					<div class="col-sm-4">
						<small><strong>Modified:</strong><?php ph('Today'); ?></small>
					</div>
				</div>
			</div>
		</div>
	</article>
</main>

