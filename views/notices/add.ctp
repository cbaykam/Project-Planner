<div class="notices form">
<?php echo $form->create('Notice');?>
	<fieldset>
 		<legend><?php __('Add Notice');?></legend>
	<?php
		echo $form->input('project_id');
		echo $form->input('noticescol');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Notices', true), array('action'=>'index'));?></li>
	</ul>
</div>
