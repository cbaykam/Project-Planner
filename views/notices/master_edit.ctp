<div class="notices form">
<?php echo $form->create('Notice');?>
	<fieldset>
 		<legend><?php __('Edit Notice');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('project_id');
		echo $form->input('noticescol');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Delete', true), array('action'=>'delete', $form->value('Notice.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $form->value('Notice.id'))); ?></li>
		<li><?php echo $html->link(__('List Notices', true), array('action'=>'index'));?></li>
	</ul>
</div>
