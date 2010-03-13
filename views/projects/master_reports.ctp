<div id="pagetitle"><h1>Project Reports </h1></div>
<div id="projectLeftSide">
<table>
	<tr>
		<th>Customer</th>
	    <th>Project</th>
	    <th>Completed</th>
	    <th>Hours</th>
	    <th>Date Done</th>
	</tr>
	<?php foreach($data as $project):?>
		<tr>
			<td><?php echo $project["Project"]["customer"]; ?></td>
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
</div>
