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
				<td><?php echo $task["name"];?></td>
				<td><?php echo $task["status"];?></td>
				<td><?php echo $task["priority"];?></td>
			</tr>
	
		<?php endforeach;?>
	
		</table>
	<?php endif; ?>
</div>

<div id="user_master_view_projects">
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
