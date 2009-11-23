<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th><?php echo $task["Task"]["id"] ?></th>
		<th>&nbsp;</th>
	</tr>
	<tr>
		<td>Name</td>
		<td><?php echo $task["Task"]["name"] ?></td>
	</tr>
	<tr>
		<td>Task Owner</td>
		<td><?php echo $task["User"]["name"] ?></td>
	</tr>
	<?php if ($depend): ?>
		<tr>
			<td>Dependency</td>
			<td><?php echo $depend["Task"]["id"] . ' [ Status ' . $depend["Task"]["status"]; ?> % ]</td>
		</tr>
	<?php endif; ?>
	<tr>
		<td>Due Date</td>
		<td><?php echo $task["Task"]["duedate"] ?></td>
	</tr>
	
</table>
