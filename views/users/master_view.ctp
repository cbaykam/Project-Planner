<h1> <?php echo $data["User"]["name"]; ?> </h1>
<div id="user_master_view_userinfo">
 <table border="0" cellspacing="0" cellpadding="0">
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
</div>
<div id="user_master_view_tasks">
	<?php if (count($data["Task"]) == 0): ?>
		<h3>No Tasks for this user</h3>
	<?php else: ?>
		<table border="0" cellspacing="0" cellpadding="0">
		
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
</div>

<div id="user_master_view_projects">
	<h3> Projects </h3>
	<?php if (count($data["Project"]) == 0): ?>
		<h3>Not working in any projects</h3>
	<?php else: ?>
		<table border="0" cellspacing="0" cellpadding="0">
		
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
</div>

<div id="holidays">
	<h3> Events  </h3>
	<?php if (count($data["Holiday"]) == 0): ?>
		<?php echo $html->link("Add Event" , array('controller' => 'holidays' , 'action' => 'add','master'=>true , $data["User"]["id"]) , array('class'=>'buttonlink') );?>
	<?php else: ?>
		<table border="0" cellspacing="0" cellpadding="0">
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
</div>
<div id="user_master_view_addtoproj">
	<fieldset>
	<?php echo $form->create('UsersProject' , array('url'=>array('controller'=>'users_projects' , 'action'=>'toproject','master'=>true , $data["User"]["id"]))); ?>
	    <select id="data[UsersProject][project_id]" name="data[UsersProject][project_id]">
		<?php foreach($projects as $project):?>
		
			<option value="<?php echo $project['Project']['id'] ?>"><?php echo $project['Project']['name'] ?></option>
		
		<?php endforeach;?>
	    </select>	
	<input type="submit" value="Add User To Project"/>
	</fieldset>
</div>
