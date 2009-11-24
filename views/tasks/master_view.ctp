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
		<td>
			<?php 
				 if(strtotime($task["Task"]["duedate"]) < time())
				 {
				 	echo $task["Task"]["duedate"] . " (Overdue)";				 	
				 }else
				 {
				 	echo $task["Task"]["duedate"] ;
				 }
			?>
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

    <?php $sum = 0; ?>
  	<?php foreach($task["Activity"] as $acti):?>
  	
  			<?php
  			
  				$sum += $acti['duration'];
  			
  			?> 
  	
  	<?php endforeach;?>
  

 <table border="0" cellspacing="0" cellpadding="0">
 	<tr>
 		<th>Activities / Notes</th>
 		<th>&nbsp;</th><th>&nbsp;</th>
 		<th>Total :</th>
 		<th><?php echo $timecal->show($sum); ?></th>
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
