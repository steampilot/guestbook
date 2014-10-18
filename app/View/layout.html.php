<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 08:47
 */
?>
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Guest Book">
	<meta name="author" content="Steampilot">
	<base href="<?php pu(__BASE_URL__); ?>">
	<link rel="icon" href="assets/ico/favicon.ico">

	<title><?php ph($app['title']); ?></title>

	<!-- Bootstrap core CSS -->
	<link href="assets/css/bootstrap.min.css" rel="stylesheet">

	<!-- Custom styles for this template -->
	<link href="assets/css/jumbotron.css" rel="stylesheet">
	<link href="assets/css/steampilot.css" rel="stylesheet">

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="assets/js/jquery-1.11.1.min.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>

</head>

<body>
<?php
include __VIEW__ . '/ViewElement/nav.html.php';
if (isset($VIEW_FILES)) {
	foreach ($VIEW_FILES as $viewFile) {
		include $viewFile;
	}
}
?>
<footer class="container">
	<hr>
	<p>&copy; Steampilot 2014</p>
</footer>
</body>
<script src="assets/js/guestbook.js">

</script>
</html>
