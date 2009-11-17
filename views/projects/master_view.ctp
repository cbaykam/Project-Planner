<div class="projects view">
<h2><?php  __('Project');?> : <?php echo $project["Project"]["name"] ?></h2>
	
	<fieldset>
	<?php echo $form->create('Project' , array('url'=>array('controller'=>'projects' , 'action'=>'adduser','master'=>true , $project["Project"]["id"]))); ?>
	    <select id="data[User][0][user_id]" name="data[User][0][user_id]">
		<?php foreach($users as $user):?>
		
			<option value="<?php echo $user['User']['id'] ?>"><?php echo $user['User']['name'] ?></option>
		
		<?php endforeach;?>
	    </select>	
	<?php echo $form->end('Add User To Project'); ?>
	</fieldset>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Project', true), array('action'=>'edit', $project['Project']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Project', true), array('action'=>'delete', $project['Project']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $project['Project']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Projects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Project', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
