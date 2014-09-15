<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:33
 */
//include_once __DIR__ .'/../head.html.php';
?>
<main class="container">
	<?php foreach ($posts as $post) {
		$html = '
			<article class="col-md-4">
				<header><h2>%s</h2></header>
				<section>
				<p>%s</p>
				<p><a class="btn btn-default" href="#">View details &raquo;</a></p>
				</section>
			</article>
		';
		echo sprintf($html,$post["subject"],$post['message']);
	}?>
</main>
<?php
//include_once __DIR__ .'/../footer.html.php'
?>