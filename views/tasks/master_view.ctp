<div id="pagetitle"><h1>Task : <?php echo $task["Task"]["id"] ?> </h1></div>	
<div id="projectLeftSide">
<table>
	<tr>
		<td>Name</td>
		<td><?php echo $task["Task"]["name"] ?></td>
	</tr>
	<tr>
		<td>Description</td>
		<td><?php echo $task["Task"]["description"] ?></td>
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
<?php echo $html->link('Edit Task' , array('controller'=>'tasks' , 'action'=>'edit' , 'master'=>true , $task["Task"]["id"], $projectid ) , array('class'=>'buttonlink'));?>
<?php if($task["Task"]["user_id"] != null):?>
<?php echo $html->link("Add An Activity / Note" , array('controller' => 'activities' , 'action' => 'add', 'master'=>true , $task["Task"]["id"] , $projectid , $task["Task"]["user_id"] ), array('class'=>'buttonlink') ); ?></li>
<?php else:?>
<h3>You must assign this task to an user before adding any notes.</h3>
<?php endif;?>
 <?php if (count($task["Activity"]) != 0): ?>
  

 <table>
 	<tr>
 		<th>Activities / Notes</th>
 		<th>&nbsp;</th><th>&nbsp;</th><th>&nbsp;</th>
 		<th>Total :</th>
 		<th><?php echo $tsk->duration($task["Activity"]); ?></th>
 	</tr>
 	<tr>
 	     <th>Date</th>
 	     <th>By</th>
 	     <th>Description</th>
 	     <th>File</th>
 	     <th>Time</th>
 	     <th>Actions</th>
 	</tr>
 	<?php foreach($task["Activity"] as $act):?>
 	
 			<tr>
 				<td><?php echo $act["date"] ?></td>
 				<td><?php echo $task["User"]["name"] ?></td>
 				<td><?php echo $text->truncate($act["description"] , 40) ?></td>
 				<td><a href="<?php echo Configure::read('appPath')?>files/<?php echo $act["file"]?>" taget="_blank"><?php echo $act["file"]?></a></td>
 				<td><?php echo $timecal->show($act["duration"]); ?></td>
 				<td><?php echo $html->link("Edit" , array('controller' => 'activities' , 'action' => 'edit','master'=>true , $act["id"] , $task["Task"]["id"] , $projectid , $task["Task"]["user_id"]) ); ?></td>
 			</tr>
 	
 	<?php endforeach;?>
 	
 	
 	
 </table>
 <?php else: ?>
 	<h3>There are no notes in this task at this time.</h3>
 <?php endif; ?>
 <?php if($projectid != 0):?>
		<?php echo $html->link("Return To Project" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $projectid), array('class'=>'buttonlink') ); ?></li>
 <?php endif;?>	
 </div>
"
