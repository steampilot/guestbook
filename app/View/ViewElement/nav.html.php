<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 09:01
 */
$submitUrl = __BASE_URL__ . 'Session/login';
$logoutUrl = __BASE_URL__ . 'Session/logout';
?>

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<section class="container">
		<header class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"><?php ph($app['title']); ?></a>
		</header>
		<div class="navbar-collapse collapse">
			<?php
			if (isset($_SESSION['active']) && $_SESSION['active'] === true) {
				$accountEditUrl = __BASE_URL__ . 'User/edit?id=' . $_SESSION['sessionUserId'];
				?>
				<div class="navbar-right">
					<a class="btn btn-danger" href="<?php ph($logoutUrl); ?>">Logout</a>
					<a class="btn btn-default" href="<?php ph($accountEditUrl); ?>">Edit Account</a>
				</div>
				<?php
				if ($_SESSION['sessionUserId'] == 1) {
					?>
					<a class="btn btn-success" href="<?php pu(__BASE_URL__ . 'User/index'); ?>">Admin</a>
				<?php
				}
			} else {
			?>
			<form class="navbar-form navbar-right" role="form" method="post" action="<?php ph($submitUrl); ?>">
				<div class="form-group">
					<input type="text" id='login_email' name='login_email' placeholder="Email"
					       class="form-control">
				</div>
				<div class="form-group">
					<input type="password" id='login_password' name='login_password'
					       placeholder="Password"
					       class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			</form>
		</div>
		<?php }; ?>

		<!--/.navbar-collapse -->
	</section>
</nav>
