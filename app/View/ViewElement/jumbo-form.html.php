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
	<div class="col-lg-4">
	<?php
	$html = ('
		<h1>%s</h1>
		<p>%s</p>
		<a href="%s" class="btn btn-primary btn-lg btn-default" role="button">Submit &raquo;
		</a>
		</p>');
	echo sprintf($html, gh($jumbo['title']), gh($jumbo['text']), gh($jumbo['submit-url']));
	?>
		</div>
	<div class="col-lg-8">
	<div style="background-color: #ffffff">
		<p>test<br> more test<br>even more test</p>
	</div>
	</div>
</header>