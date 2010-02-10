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
		<?php if (isset($task["User"]["name"])): ?>
			<td>Task Owner</td>
			<td><?php echo $task["User"]["name"] ?></td>
		<?php else: ?>
			<td>Task Owner</td>
			<td>(None)</td>
		<?php endif; ?>
	</tr>
	<?php if ($depend): ?>
		<tr>
			<td>Dependency</td>
			<td><?php echo $depend["Task"]["id"] . ' [ Status ' . $depend["Task"]["status"]; ?> % ]</td>
		</tr>
	<?php endif; ?>
	<?php if($projectid != 0):?>
		<tr>
			<td>Project Phase</td>
			<td><?php echo $task["Milestone"]["name"];?></td>
		</tr>
	<?php endif;?>
	<tr>
		<td>Last Update</td>
		<td>
			<?php if ($task["Task"]["modified"] == '0000-00-00'): ?>
				<?php echo $timecal->format($task["Task"]["created"]);?>
			<?php else: ?>
				<?php echo $timecal->format($task["Task"]["modified"]);?>
			<?php endif; ?>
		</td>
	</tr>
	
	<tr>
		<td>Due Date</td>
		<td>
			<?php echo $tsk->overdue($task["Task"]["duedate"]);?>
		</td>
	</tr>
	<tr>
		<td>Status</td>
		<td><?php echo $task["Task"]["status"] ?> %</td>
	</tr>
	
</table>
<?php if($task["Task"]["user_id"] != null):?>
<?php echo $html->link("Add An Activity / Note" , array('controller' => 'activities' , 'action' => 'add', $task["Task"]["id"] , $projectid , $task["Task"]["user_id"] ), array('class'=>'buttonlink') ); ?></li>
<?php else:?>
<h3>You must assign this task to an user before adding any notes.</h3>
<?php endif;?>
 <?php if (count($task["Activity"]) != 0): ?>
  

 <table border="0" cellspacing="0" cellpadding="0">
 	<tr>
 		<th>Activities / Notes</th>
 		<th>&nbsp;</th><th>&nbsp;</th>
 		<th>Total :</th>
 		<th><?php echo $tsk->duration($task["Activity"]); ?></th>
 	</tr>
 	<tr>
 	     <th>Date</th>
 	     <th>By</th>
 	     <th>Description</th>
 	     <th>Time</th>
 	     <th>Actions</th>
 	</tr>
 	<?php foreach($task["Activity"] as $act):?>
 	
 			<tr>
 				<td><?php echo $act["date"] ?></td>
 				<td><?php echo $task["User"]["name"] ?></td>
 				<td><?php echo $act["description"] ?></td>
 				<td><?php echo $timecal->show($act["duration"]); ?></td>
 				<td><?php echo $html->link("Edit" , array('controller' => 'activities' , 'action' => 'edit' , $act["id"] , $task["Task"]["id"] , $projectid , $task["Task"]["user_id"]) ); ?></td>
 			</tr>
 	
 	<?php endforeach;?>
 	
 	
 	
 </table>
 <?php else: ?>
 	<h3>There are no notes in this task at this time.</h3>
 <?php endif; ?>
 <?php if($projectid != 0):?>
		<?php echo $html->link("Return To Project" , array('controller' => 'projects' , 'action' => 'view', $projectid), array('class'=>'buttonlink') ); ?></li>
 <?php endif;?>	
