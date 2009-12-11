<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('overview' , array('type'=>'text') );
		echo $form->input('user_id' , array('label'=>'Project Admin'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
