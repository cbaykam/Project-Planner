<div class="usersProjects form">
<?php echo $form->create('UsersProject');?>
	<fieldset>
 		<legend><?php __('Add UsersProject');?></legend>
	<?php
		echo $form->input('user_id');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List UsersProjects', true), array('action'=>'index'));?></li>
	</ul>
</div>
