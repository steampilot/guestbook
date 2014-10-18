<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 15:43
 */


$today = $app['today'];
$btnUrl = __BASE_URL__ . 'Post/index';
$btnText = 'Back to the List';
$id = $user['id'];
$name = $user['name'];
$email = $user['email'];
$created = $user['created'];
$modified = $today;
$submitUrl = __BASE_URL__ . 'User/edit?id=' . $id;
$passwordEditUrl = __BASE_URL__ . 'User/changePassword?id=' . $id;
$alert = false;
if (!empty($_POST)) {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$alert = true;
}
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
				<h3>Change Password</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="id" name="id" value="<?php ph($id); ?>"
					<input type="hidden" id="created" name="created" value="<?php ph($created); ?>">
					<input type="hidden" id="modified" name="modified" value="<?php ph($today); ?>">

					<div class="form-group">
						<label for="password-old">Password-old</label>
						<input type="password" class="form-control" name="password-old" id="password-old" size="32">
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
						<small><strong>Created:</strong><?php ph($created); ?></small>
					</div>
					<div class="col-sm-4">
						<small><strong>Modified:</strong><?php ph($today); ?></small>
					</div>
				</div>
			</div>
	</article>
</main>