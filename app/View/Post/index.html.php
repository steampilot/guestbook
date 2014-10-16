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
	$author_name = $post['author_name'];
	$editUrl = __BASE_URL__.'Post/edit?id='.$post['id'];
	$deleteUrl = __BASE_URL__.'Post/delete?id='.$post['id'];
	?>
	<article class="col-md-2 ">
		<header>
			<h2><?php ph($subject);?></h2>
			<small>
				<?php ph($author_name); ?>
			</small>
			<?php if(isset($_SESSION['sessionUserId']) && $_SESSION['sessionUserId'] === $post['author_id']){?>
			<a class="btn-small btn-success inline" href="<?php ph($editUrl); ?>">Edit</a>
			<a class="btn-small btn-danger inline" href="<?php ph($deleteUrl); ?>">Delete</a>
			<?php } ?>
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
	<?php }// end foreach?>
</main>
