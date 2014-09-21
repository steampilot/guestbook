<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:33
 */
?>
<main class="container">
	<?php foreach ($users as $user) {
		$html = '
			<article class="col-md-4">
				<header><h2>%s</h2></header>
				<section>
				<p>%s</p>
				<p><a class="btn btn-default" href="%s">View details &raquo;</a></p>
				</section>
			</article>
		';
		echo (sprintf($html,gh($user['name']),ghbr($user['email']),gu($user['btn-url'])));
	}?>
</main>