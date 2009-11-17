<div class="projects view">
<h2><?php  __('Project');?> : <?php echo $project["Project"]["name"] ?></h2>
	
	<?php if (count($project["User"]) != 0): ?>
		<table border="0" cellspacing="0" cellpadding="0">
		<?php foreach($project["User"] as $usr):?>
			<tr>
				<td><?php echo $usr["name"]; ?></td>
				<td><?php echo $html->link("Add Task" , array('controller' => 'tasks' , 'action' => 'add' , $project["Project"]["id"] , $usr["id"]) ); ?>
			</tr>
		<?php endforeach;?>
		</table>
	<?php else: ?>
		<h2>No Users In the project</h2>
	<?php endif; ?>
	
	<fieldset>
	<?php echo $form->create('UsersProject' , array('url'=>array('controller'=>'users_projects' , 'action'=>'add','master'=>true , $project["Project"]["id"]))); ?>
	    <select id="data[UsersProject][user_id]" name="data[UsersProject][user_id]">
		<?php foreach($users as $user):?>
		
			<option value="<?php echo $user['User']['id'] ?>"><?php echo $user['User']['name'] ?></option>
		
		<?php endforeach;?>
	    </select>	
	<input type="submit" value="Add User To Project"/>
	</fieldset>
</div>
