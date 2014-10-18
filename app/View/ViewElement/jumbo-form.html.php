<?php
/**
 * Created by PhpStorm.
 * User: Jérôme
 * Date: 15.09.14
 * Time: 09:31
 */
?>
<!-- Main jumbotron for a primary marketing message or call to action -->
<header class="container-fluid">
	<div class="jumbotron col-lg-4">
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
		<form class="modal-form panel" role="form" name="post" action="#" method="post">
			<div class="panel-heading">Post</div>
			<div class="input-group">
				<span class="input-group-addon">Subject</span>
				<input name="subject" type="text" class="form-control" placeholder="Headline">
			</div>
			<div class="input-group">
				<textarea placeholder="Describe yourself with 4 words..." class="form-control col-lg-8" rows="8"
				          cols="102" name="message"></textarea>
			</div>
		</form>
	</div>
</header>