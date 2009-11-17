<div class="milestones form">
<?php echo $form->create('Milestone');?>
	<fieldset>
 		<legend><?php __('Edit Milestone');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Milestone.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Milestone.id'))); ?></li>
		<li><?php echo $html->link(__('List Milestones', true), array('action'=>'index'));?></li>
	</ul>
</div>
