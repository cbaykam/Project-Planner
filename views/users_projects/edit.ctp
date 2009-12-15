<div class="usersProjects form">
<?php echo $form->create('UsersProject');?>
	<fieldset>
 		<legend><?php __('Edit UsersProject');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('user_id');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('UsersProject.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('UsersProject.id'))); ?></li>
		<li><?php echo $html->link(__('List UsersProjects', true), array('action'=>'index'));?></li>
	</ul>
</div>
