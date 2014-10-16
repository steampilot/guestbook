<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 15:43
 */



$session_user_id = 2;
$today = $app['today'];
$btnUrl = __BASE_URL__.'User/index';
$btnText = 'Back to the List';
$id = $user['id'];
$name = $user['name'];
$email = $user['email'];
$role = $user['role'];
$created = $user['created'];
$modified = $today;
$submitUrl = __BASE_URL__.'User/edit?id='.$id;
?>

<main class="container">
	<header class="jumbo-narrow col-lg-4">
		<h1>
			Create New User
		</h1>
		<p>
			Password will be set afterwards
		</p>
		<p>
			<a href="<?php pu($btnUrl);?>" class="btn btn-primary btn-lg" role="button"><?php ph($btnText);?> &raquo;</a>
		</p>
	</header>
	<article id='postView' class="col-lg-8">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3>Account Settings</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="created" name="created" value="<?php ph($created); ?>">
					<input type="hidden" id="modified" name="modified" value="<?php ph($today); ?>">
					<input type="hidden" name="role" value="<?php ph($role); ?>">
					<div class="form-group">
						<label for="subject">Name</label>
						<input type="text" class="form-control"
						       name="name" id="name"
						       placeholder="Human readable name" value="<?php ph($name); ?>">
					</div>
					<div class="form-group">
						<label for="subject">Email</label>
						<input type="email" class="form-control"
						       value="<?php ph($email); ?>" name="email"
						       id="email"
						       placeholder="your@email.com">
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