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
	$btnUrl = __BASE_URL__.'Post/view?id='.$post['id'];
	$subject = $post['subject'];
	$message = $post['message'];
		$name = $post['name'];
	?>
	<article class="col-md-4 ">
		<header>
			<h2><?php ph($subject);?></h2>
			<small>
				<?php ph($name); ?>
			</small>
		</header>
		<hr>
		<section>
		<p><?php ph($message);?></p>
		</section>
		<footer>
			<hr>

		<p><a class="btn btn-default" href="<?php pu($btnUrl);?>">View details &raquo;</a></p>
		</footer>
	</article>
	<?php }?>
</main>
