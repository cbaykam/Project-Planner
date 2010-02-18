<div class="holidays form">
<?php echo $form->create('Holiday');?>
	<fieldset>
 		<legend><?php __('Edit Holiday');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('description');
		echo $form->input('start');
		echo $form->input('end');
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Holiday.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Holiday.id'))); ?></li>
		<li><?php echo $html->link(__('List Holidays', true), array('action'=>'index'));?></li>
	</ul>
</div>
