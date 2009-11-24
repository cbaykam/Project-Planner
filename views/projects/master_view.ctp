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
					<td><?php echo $html->link("Add Task" , array('controller' => 'tasks' , 'action' => 'add' , 'master'=>true ,$project["Project"]["id"] , $usr["id"]) ); ?> | <?php echo $html->link("View Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser' , 'master'=>true, $usr["id"], $project["Project"]["id"]) ); ?> | <?php echo $html->link("Kick User" , array('controller' => 'users_projects' , 'action' => 'delete','master'=>true , $project["Project"]["id"] , $usr["id"]) ); ?>
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
					<th>Actions</th>
				</tr>
			<?php foreach($tasks as $task):?>
			
				<tr>
					<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
					<td><?php echo $priority->display($task["Task"]["priority"]); ?></td>
					<td><?php echo $task["Task"]["status"]; ?> %</td>
					<?php if ($task["Task"]["user_id"] == 0): ?>
					 <td>
						<?php echo $form->create("Task" , array('url'=>array('controller'=>'tasks' , 'action'=>'assign' , 'master'=>true, $task["Task"]["id"] , $project["Project"]["id"]) ) ); ?>
						 <select id="TaskUsersa" name="data[Task][usersa]">
						   <option value="">Select one</option>
						  <?php foreach($usersa as $option):?>
						  	 <option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
						  <?php endforeach;?>
						 </select>
						 <input type="submit" value="assign"/> 
						 </form>
					 </td>
					<?php else: ?>
						<td><?php echo $task["Task"]["user_id"]; ?>
					<?php endif; ?>
					<td><?php echo $html->link("Delete task" , array('controller' => 'tasks' , 'action' => 'delete','master'=>true , $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
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
	<div id="project_links_menu">
		<?php if (count($project["Link"]) != 0): ?>
				<table border="0" cellspacing="0" cellpadding="0">
					<tr>
						<th>Name</th>
						<th>Link</th>
						<th>Actions</th>
					</tr>
				<?php foreach($project["Link"] as $link):?>
				    <tr>
				    	<td><?php echo $link["name"]; ?></td>
				    	<td><a href="<?php echo $link['link'] ?>"><?php echo $link['link'] ?></td>
				    	<td><?php echo $html->link("Delete" , array('controller' => 'links' , 'action' => 'delete','master'=>true , $link["id"] , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'links' , 'action' => 'edit','master'=>true , $link["id"] , $project["Project"]["id"]) ); ?></td>
				    </tr>
				<?php endforeach;?>	
				</table>
				<ul>
				<li><?php echo $html->link("Add Link" , array('controller' => 'links' , 'action' => 'add','master'=>true, $project["Project"]["id"] ) ); ?></li>
				</ul>
		<?php else: ?>
			<h3>No Links at the project. Please Click <?php echo $html->link("Here" , array('controller' => 'links' , 'action' => 'add','master'=>true , $project["Project"]["id"]) ); ?> to add a link</h3>
		<?php endif; ?>	
	</div>
	<fieldset>
		<?php echo $form->create('UsersProject' , array('url'=>array('controller'=>'users_projects' , 'action'=>'add','master'=>true , $project["Project"]["id"]))); ?>
		<?php echo $form->input("user_id" , array('label'=>'Resource') ); ?>
		<input type="submit" value="Add User to Project"/>	
		</form>
	</fieldset>
</div>

