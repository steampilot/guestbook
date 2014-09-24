<?php
/**
 * Created by PhpStorm.
 * User: Jerome Roethlisberger
 * Date: 24.09.14
 * Time: 15:43
 */


$html = ('
	<form role="form" action="%s" method="get">
		<div class="container">
			<div class="form-group-lg">
				<label for="subject">Subject</label>
				<input type="text" class="form-control" id="subject" placeholder="What is this all about?">
			</div>
			<div class="form-group-lg">
				<label for="message">Message</label>
				<textarea id="message" class="form-control" rows="3" cols="255"
				          placeholder="Now lets hear what You have to say!"></textarea>
			</div>
		<button type="submit" class="btn-default">Submit</button>
	</div>
</form>
');
echo sprintf($html,__BASE_URL__.'/Post/edit?id='.'1');
$_POST['id'] = 1;
