<?php echo $javascript->link('jquery-1.3.2.min' , false); ?>
<?php echo $javascript->link('milestones' , false); ?>
<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('overview' , array('type'=>'text') );
		echo $form->input('user_id' , array('label'=>'Project Admin'));
		echo $form->input('redalto' , array('label'=>'Project Type' , 'type'=>'select' , 'options'=>array('0'=>'Customer Maintanance' , '1'=>'Redalto Project') ) );
		
	?>
	
	<div id="milestones">
		<a href="#" id="addMilestones">Add Standart Milestones</a>
	</div>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
