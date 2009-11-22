<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
