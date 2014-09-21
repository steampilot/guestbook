<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 15.09.14
 * Time: 19:11
 */ ?>
<main class="container">
	<div class="panel panel-default">
		<div class="panel-heading">
			<?php echo $post['id'].' '. $post['subject']; ?>
		</div>
		<div class="panel-body">
			<?php echo $post['message']; ?>
		</div>
		<div class="panel-footer">
			this is the panel footer
		</div>
	</div>
</main>