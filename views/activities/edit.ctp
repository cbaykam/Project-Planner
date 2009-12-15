<div class="activities form">
<?php echo $form->create('Activity');?>
	<fieldset>
 		<legend><?php __('Edit Activity');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('task_id');
		echo $form->input('duration');
		echo $form->input('description');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Activity.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Activity.id'))); ?></li>
		<li><?php echo $html->link(__('List Activities', true), array('action'=>'index'));?></li>
	</ul>
</div>
