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
	
	<tr>
		<td>Project Phase</td>
		<td><?php echo $task["Milestone"]["name"];?></td>
	</tr>
	
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
<ul>
<li><?php echo $html->link("Add An Activity / Note" , array('controller' => 'activities' , 'action' => 'add', 'master'=>true , $task["Task"]["id"] , $this->params["pass"][1]) ); ?></li>
</ul>
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
 				<td><?php echo $act["user_id"] ?></td>
 				<td><?php echo $act["description"] ?></td>
 				<td><?php echo $timecal->show($act["duration"]); ?></td>
 				<td><?php echo $html->link("Edit" , array('controller' => 'activities' , 'action' => 'edit','master'=>true , $act["id"] , $task["Task"]["id"] , $this->params["pass"][1]) ); ?></td>
 			</tr>
 	
 	<?php endforeach;?>
 	
 	
 	
 </table>
 <?php else: ?>
 	<h3>There are no notes in this task at this time.</h3>
 <?php endif; ?>
 <ul>
 <li><?php echo $html->link("Return To Project" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $this->params["pass"][1]) ); ?></li>
 </ul>
