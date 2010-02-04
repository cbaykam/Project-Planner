<?php echo $javascript->link('jquery-1.3.2.min' , false); ?>
<?php echo $javascript->link('milestones' , false); ?>
<div class="projects form">
<?php echo $form->create('Project');?>
	<fieldset>
 		<legend><?php __('Add Project');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('overview' , array('type'=>'textfield') );
		echo $form->input('user_id' , array('label'=>'Project Manager'));
		echo $form->input('redalto' , array('label'=>'Project Type' , 'type'=>'select' , 'options'=>array('0'=>'Customer Project' , '1'=>'Redalto Project') ) );
		echo $form->input('customer_id');
	?>
	<br><br>
		<span class="duration">
			Budget 
		</span>
	    	<input id="ProjectName" type="text" value="" maxlength="128" name="data[Project][hours]" size="4"/>	
				Hrs
			<input id="ProjectName" type="text" value="" maxlength="128" name="data[Project][mins]" size="4"/>
			Mins
	<div id="milestones">
		<a href="#" id="addMilestones">Add Standart Milestones</a>
	</div>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>