<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 09:31
 */
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<header class="jumbotron container">
	<?php
	$html = ('
		<h1>%s</h1>
		<p>%s</p>
		<a href="%s" class="btn btn-primary btn-lg" role="button">%s &raquo;
		</a>
		</p>');
	echo sprintf($html, gh($app['title']), gh($jumbo['text']), gh($jumbo['btn-url']), gh($jumbo['btn-text']));
	?>
</header>
