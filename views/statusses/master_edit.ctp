<div class="statusses form">
<?php echo $form->create('Statuss');?>
	<fieldset>
 		<legend><?php __('Edit Statuss');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('project_id');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Statuss.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Statuss.id'))); ?></li>
		<li><?php echo $html->link(__('List Statusses', true), array('action'=>'index'));?></li>
	</ul>
</div>
