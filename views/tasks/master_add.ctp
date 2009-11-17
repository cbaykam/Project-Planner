<div class="tasks form">
<?php echo $form->create('Task');?>
	<fieldset>
 		<legend><?php __('Add Task');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('project_id');
		echo $form->input('status');
		echo $form->input('priority');
		echo $form->input('type');
		echo $form->input('description');
		echo $form->input('duedate');
		echo $form->input('resource_id');
		echo $form->input('dependency');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Tasks', true), array('action'=>'index'));?></li>
	</ul>
</div>
