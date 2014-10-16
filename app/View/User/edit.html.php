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
var_dump($this);
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
				<h3>Write a Post</h3>
			</div>
			<div class="panel-body">
				<form role="form" class="" accept-charset="UTF-8" action="<?php pu($submitUrl); ?>" method="post">
					<input type="hidden" id="created" name="created" value="<?php ph($created); ?>">
					<input type="hidden" id="modified" name="modified" value="<?php ph($modified); ?>">
					<input type="hidden" name="role" value="<?php ph($role); ?>">
					<div class="form-group">
						<label for="subject">Name</label>
						<input type="text" class="form-control" name="name" id="name" value="<?php ph($name); ?>">
					</div
					<div class="form-group">
						<label for="subject">Email</label>
						<input type="email" class="form-control" name="email" id="email" <?php ph($email); ?>>
					</div>
					<div class="form-inline">
						<button type="role" class="btn btn-default">Role</button>
						<div class="col-lg-offset-1">
							<label class="radio-inline">
								<input type="radio" name="role" id="role1" value="1"> Admin
							</label>
							<label class="radio-inline">
								<input type="radio" name="role" id="role2" value="2"> Author
							</label>
							<label class="radio-inline">
								<input type="radio" name="role" id="role3" value="3"> Guest
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