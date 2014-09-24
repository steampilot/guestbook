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
	$btnUrl = __BASE_URL__.'Post/view?id='.$post['id'];   ?>
	<article class="col-md-4">
		<header><h2><? ph($post['subject']);?></h2></header>
		<section>
		<p><?php ph($post['message']);?></p>
		<p><a class="btn btn-default" href="<?php pu($btnUrl);?>">View details &raquo;</a></p>
		</section>
	</article>
	<?php }?>
</main>
