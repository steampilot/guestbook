<?php
/**
 * Created by PhpStorm.
 * User: ShinKenDo
 * Date: 14.09.14
 * Time: 00:33
 */
?>
<main class="container">
	<table class="table table-striped table-hover">
		<tr>
			<th>
				Name
			</th>
			<th>
				Email
			</th>
			<th>
				Role
			</th>
			<th>
				Action
			</th>
		</tr>
		<?php foreach ($users as $user) {
			$viewUrl = __BASE_URL__ . 'User/view?id=' . $user['id'];
			$editUrl = __BASE_URL__ . 'User/edit?id=' . $user['id'];
			$deleteUrl = __BASE_URL__ . 'User/delete?id=' . $user['id'];
			$setPasswordUrl = __BASE_URL__ . 'User/view?id=' . $user['id'];
			?>
			<tr>
				<td>
					<?php ph($user['name']); ?>
				</td>
				<td>
					<?php ph($user['email']); ?>
				</td>
				<td>
					<?php ph($user['roleName']); ?>
				</td>
				<td>
					<a href="<?php ph($viewUrl); ?>" class="btn btn-default btn-group-xs">View</a>
					<a href="<?php ph($setPasswordUrl); ?>" class="btn btn-default btn-group-xs">Set Password</a>
					<a href="<?php ph($editUrl); ?>" class="btn btn-primary btn-group-xs">Edit</a>
					<a href="<?php ph($deleteUrl); ?>" class="btn btn-danger btn-group-xs">Delete</a>
				</td>
			</tr>
		<?php } ?>
	</table>
</main>
