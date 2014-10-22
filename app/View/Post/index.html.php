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
		$btnUrl = __BASE_URL__ . 'Post/view?id=' . $post['id'];
		$subject = $post['subject'];
		$message = $post['message'];
		$author_name = $post['author_name'];
		$created = $post['created'];
		$created = substr($post['created'], 0, 10);
		$editUrl = __BASE_URL__ . 'Post/edit?id=' . $post['id'];
		$deleteUrl = __BASE_URL__ . 'Post/delete?id=' . $post['id'];
		?>
		<article class="article col-md-3">
			<header>
				<small>
					<strong>
						<?php ph($author_name); ?>
					</strong>
					Created: <?php ph($created); ?>
				</small>
				<h3><?php ph($subject); ?></h3>
			</header>
			<section>
				<p><strong>
						<?php ph($message); ?>
					</strong>
				</p>
			</section>
			<footer>
				<a class="btn btn-small btn-default inline" href="<?php pu($btnUrl); ?>">View details &raquo;</a>
				<?php if (isset($_SESSION['sessionUserId']) && $_SESSION['sessionUserId'] === $post['author_id']) { ?>
					<a class="btn btn-xs btn-success inline" href="<?php ph($editUrl); ?>">Edit</a>
					<a class="btn btn-xs btn-danger inline" href="<?php ph($deleteUrl); ?>">Delete</a>
				<?php } ?>
				<hr>
			</footer>
		</article>
	<?php }// end foreach?>
</main>
