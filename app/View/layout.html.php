<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Guest Book">
	<meta name="author" content="Steampilot">
	<link rel="icon" href="/assets/ico/favicon.ico">

	<title>SPGB - Steampilot Guest Book</title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="assets/css/jumbotron.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
	<section class="container">
		<header class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">SPGB - Steampilot Guest Book</a>
		</header>
		<div class="navbar-collapse collapse">
			<form class="navbar-form navbar-right" role="form">
				<div class="form-group">
					<input type="text" placeholder="Email" class="form-control">
				</div>
				<div class="form-group">
					<input type="password" placeholder="Password" class="form-control">
				</div>
				<button type="submit" class="btn btn-success">Sign in</button>
			</form>
		</div>
		<!--/.navbar-collapse -->
	</section>
</nav>

<!-- Main jumbotron for a primary marketing message or call to action -->
<header class="jumbotron">
	<section class="container">
		<h1>SPGB Steampilot Guest Book</h1>

		<p>Tell me how awesome this guest book is by writing a post!</p>

		<p><a class="btn btn-primary btn-lg" role="button">Create Post &raquo;</a></p>
	</section>
</header>
<main class="container">
	<?php include __DIR__.'/Post/index.html.php';?>
</main>
<footer class="container">
	<hr>
	<p>&copy; Steampilot 2014</p>
</footer>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
<script src="assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
