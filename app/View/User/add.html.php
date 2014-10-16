<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */


$session_user_id = 2;
$today = $app['today'];
$btnUrl = __BASE_URL__.'User/index';
$btnText = 'Back to the List';
$submitUrl = __BASE_URL__.'User/add'
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
					<input type="hidden" id="created" name="created" value="<?php ph($today); ?>">
					<input type="hidden" name="role" value="3">
					<div class="form-group">
						<label for="subject">Name</label>
						<input type="text" class="form-control" name="name" id="name" placeholder="Human readable name">
					</div>
					<div class="form-group">
						<label for="subject">Email</label>
						<input type="email" class="form-control" name="email" id="email" placeholder="you@email.com">
					</div>
					<div class="form-group">
						<label for="password">Password</label>
						<input type="password" class="form-control" name="password" id="password" size="32">
					</div>
					<div class="form-group">
						<label for="password-check">Retype Password</label>
						<input class="form-control" type="password" name="password-check" id="password-check"  size="32">
					</div>
					<div class="form-inline">
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
					<button type="submit" id='submit' class="btn btn-default">Submit</button>
				</form>
			</div>
			<div class="panel-footer">
				created Today
			</div>
		</div>
	</article>
</main>

