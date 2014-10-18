<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 09:31
 * @var $jumbo Array The ViewVars set by the controller
 */
use \Config\Config;

if (isset($jumbo)) {
	$title = $jumbo['title'];
	$text = $jumbo['text'];
	$btnUrl = $jumbo['btn-url'];
	$btnText = $jumbo['btn-text'];
} else {
	$title = Config::get('app.name');
	$text = 'Welcome!';
	$btnUrl = __BASE_URL__;
	$btnText = 'Go there!';
}
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<header class="jumbotron container">
	<h1>
		<?php ph($title); ?>
	</h1>

	<p>
		<?php ph($text); ?>
	</p>

	<p>
		<a href="<?php pu($btnUrl); ?>" class="btn btn-primary btn-lg" role="button"><?php ph($btnText); ?> &raquo;</a>
	</p>
</header>
