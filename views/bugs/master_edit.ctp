<div class="bugs form">
<?php echo $form->create('Bug');?>
	<fieldset>
 		<legend><?php __('Edit Bug');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('description');
		echo $form->input('projects_id');
		echo $form->input('priority');
		echo $form->input('status');
		echo $form->input('datedone');
		echo $form->input('time');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Bug.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Bug.id'))); ?></li>
		<li><?php echo $html->link(__('List Bugs', true), array('action'=>'index'));?></li>
	</ul>
</div>
