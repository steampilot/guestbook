<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:33
 */
?>
<main class="container">
	<?php foreach ($posts as $post) {
		$html = '
			<article class="col-md-4">
				<header><h2>%s</h2></header>
				<section>
				<p>%s</p>
				<p><a class="btn btn-default" href="?table=post&action=view&id=%s">View details &raquo;</a></p>
				</section>
			</article>
		';
		echo (sprintf($html,gh($post['subject']),ghbr($post['message']),gh($post['id'])));
	}?>
</main>