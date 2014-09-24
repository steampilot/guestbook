<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 13:55
 */
?>
<header class="jumbotron container">
	<?php
	$html = ('
		<h1>%s</h1>
		<p>%s</p>
		<a href="%s" class="btn btn-primary btn-danger btn-lg" role="button">%s &raquo;
		</a>
		</p>');
	echo sprintf($html, gh($error['title']), gh($error['text']), gu($error['btn-url']), gh($error['btn-text']));
	?>
</header>