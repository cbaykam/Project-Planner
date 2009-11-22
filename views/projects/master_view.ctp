<div class="projects view">
<h2><?php  __('Project');?> : <?php echo $project["Project"]["name"] ?></h2>
	
	<div id="users_in_project"></div>
		<?php if (count($project["User"]) != 0): ?>
			<table border="0" cellspacing="0" cellpadding="0">
			<thead>
				<th>Users in the Project</th>
				<th>Actions</th>
			</thead>
			<?php foreach($project["User"] as $usr):?>
				<tr>
					<td><?php echo $html->link($usr["name"] , array('controller' => 'users' , 'action' => 'view','master'=>true , $usr["id"]) ); ?></td>
					<td><?php echo $html->link("Add Task" , array('controller' => 'tasks' , 'action' => 'add' , 'master'=>true ,$project["Project"]["id"] , $usr["id"]) ); ?> | <?php echo $html->link("View Tasks" , array('controller' => 'tasks' , 'action' => 'view' , 'master'=>true , $project["Project"]["id"] , $usr["id"]) ); ?>
				</tr>
			<?php endforeach;?>
			</table>
		<?php else: ?>
			<h2>No Users In the project</h2>
		<?php endif; ?>
	</div>
	
	<div id="tasks_in_project">
		<?php if (count($project["Task"])): ?>
			<table border="0" cellspacing="0" cellpadding="0">
				<tr>
					<th>Task</th>
					<th>Priority</th>
					<th>Status</th>
					<th>User</th>
				</tr>
			<?php foreach($project["Task"] as $task):?>
			
				<tr>
					<td><?php echo $task["name"]; ?></td>
					<td><?php echo $priority->display($task["priority"]); ?></td>
					<td><?php echo $task["status"]; ?> %</td>
					<?php if ($task["user_id"] == 0): ?>
					 <td>
						<?php echo $form->create("Task" , array('url'=>array('controller'=>'tasks' , 'action'=>'assign' , 'master'=>true) ) ); ?>
						 <?php echo $form->input('usersa' , array('empty'=>'select one' , 'options'=>$usersa , 'type'=>'select') ); ?>
						<input type="submit" value="assign"/>
					 </td>
					<?php else: ?>
						<td><?php echo $task["user_id"]; ?>
					<?php endif; ?>
				</tr>		
			
			<?php endforeach;?>
			</table>
			<ul>
			<li><?php echo $html->link("Add Another Task" , array('controller' => 'tasks' , 'action' => 'add','master'=>true , $project["Project"]["id"]) ); ?></li>
			</ul>
		<?php else: ?>
		
			<h3>No tasks in the project click <?php echo $html->link("here" , array('controller' => 'tasks' , 'action' => 'add','master'=>true , $project["Project"]["id"]) ); ?> to add one.</h3>
		<?php endif; ?>
	
	
	</div>	
	
	<fieldset>
		<?php echo $form->create('UsersProject' , array('url'=>array('controller'=>'users_projects' , 'action'=>'add','master'=>true , $project["Project"]["id"]))); ?>
		<?php echo $form->input("user_id" , array('label'=>'Resource') ); ?>
		<input type="submit" value="Add User to Project"/>	
	
	</fieldset>
</div>

