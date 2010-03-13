<div id="pagetitle"><h1><?php echo $data["User"]["name"]; ?> </h1></div>
<div id="projectLeftSide">

 <table>
 	<tr>
 		<td><b>Email</b></td>
 		<td><?php echo $data["User"]["email"]; ?></td>
 	</tr>
 	<tr>
 		<td><b>Skype</b></td>
 		<td><?php echo $data["User"]["skype"]; ?></td>
 	</tr>
 	<tr>
 		<td><b>Messenger</b></td>
 		<td><?php echo $data["User"]["messenger"]; ?></td>
 	</tr>
 	
 </table>

<div id="user_master_view_tasks">
	<?php if($data["User"]["redalto"] == 1): ?>
		<?php if (count($data["Task"]) == 0): ?>
			<h3>No Tasks for this user</h3>
		<?php else: ?>
			<table>
			
				<tr>
					<th>Task Name</th>
					<th>Status</th>
					<th>Priority</th>
				</tr>
			<?php foreach($data["Task"] as $task):?>
		
				<tr>
					<td><?php echo $html->link($task["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["id"]) );?></td>
					<td><?php echo $task["status"];?> %</td>
					<td><?php echo $priority->display($task["priority"]);?></td>
				</tr>
		
			<?php endforeach;?>
		
			</table>
		<?php endif; ?>
	<?php endif;?>
</div>

<div id="user_master_view_projects">
	
	<h3> Projects </h3>
	<?php if($data["User"]["redalto"] == 1):?>
		<?php if (count($data["Project"]) == 0): ?>
			Not working in any projects
		<?php else: ?>
			<table>
			
				<tr>
					<th>Project Name</th>
				</tr>
			<?php foreach($data["Project"] as $prj):?>
		
				<tr>
					<td><?php echo $html->link($prj["name"] , array('controller' => 'projects' , 'action' => 'view','master'=>true , $prj["id"]) ); ?></td>
				</tr>
		
			<?php endforeach;?>
		
			</table>
		<?php endif; ?>
	<?php else:?>
		<?php if (count($custProj) == 0): ?>
			This Customer does not have any projects
		<?php else: ?>
			<table>
			
				<tr>
					<th>Project Name</th>
				</tr>
			<?php foreach($custProj as $prj):?>
		
				<tr>
					<td><?php echo $html->link($prj["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view','master'=>true , $prj["Project"]["id"]) ); ?></td>
				</tr>
		
			<?php endforeach;?>
		
			</table>
		<?php endif; ?>		
	<?php endif;?>
</div>

<div id="holidays">
	<h3> Events  </h3>
	<?php if (count($data["Holiday"]) == 0): ?>
		<?php echo $html->link("Add Event" , array('controller' => 'holidays' , 'action' => 'add','master'=>true , $data["User"]["id"]) , array('class'=>'buttonlink') );?>
	<?php else: ?>
		<table>
			<tr>
				<th>Description</th>
				<th>Type</th>
				<th>Start</th>
				<th>End</th>
			</tr>
			<?php foreach($data["Holiday"] as $holiday):?>
			
					<tr>
						<td><?php echo $holiday["description"]; ?></td>
						<td>
							<?php if ($holiday["type"] == 'o'): ?>
								Other
							<?php else: ?>
								Holiday / Vacation
							<?php endif; ?>
						</td>
						<td><?php echo $holiday["start"]; ?></td>
						<td><?php echo $holiday["end"]; ?></td>
					</tr>
			
			<?php endforeach;?>
			
		</table>
	<?php endif; ?>
	<?php echo $html->link('Add Project' , array('controller'=>'projects' , 'action'=>'add' , 'master'=>true ,$data["User"]["id"]) , array('class'=>'buttonlink'));?>
</div>

</div>
