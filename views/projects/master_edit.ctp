<div id="pagetitle"><h1><?php __('Rename Project');?> </h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Project');?>
	<fieldset>

	<?php
		echo $form->input('id');
		echo $form->input('name' , array('label'=>'Project Name'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
