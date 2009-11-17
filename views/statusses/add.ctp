<div class="statusses form">
<?php echo $form->create('Statuss');?>
	<fieldset>
 		<legend><?php __('Add Statuss');?></legend>
	<?php
		echo $form->input('project_id');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Statusses', true), array('action'=>'index'));?></li>
	</ul>
</div>
