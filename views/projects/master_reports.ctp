<h3> Project Duration </h3>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
	    <th>Project</th>
	    <th>Completed</th>
	    <th>Hours</th>
	    <th>Date Done</th>
	</tr>
	<?php foreach($data as $project):?>
		<tr>
			<td><?php echo $project["Project"]["name"]; ?></td>
			<td>
				<?php if ($project["Project"]["currstats"] == 'arch'): ?>
					Yes
				<?php else: ?>
					No
				<?php endif; ?>
			</td>
			<td><?php echo $timecal->show($project["duration"]); ?></td>
			<td></td>

		</tr>
	
	<?php endforeach;?>
	
</table>
