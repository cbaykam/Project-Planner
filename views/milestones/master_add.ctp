<?php echo $html->css('farbtastic' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('farbtastic' , false); ?>
<?php echo $javascript->link('fbts' , false); ?>
<div class="milestones form">
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'add','master'=>true , $this->params['pass'][0])));?>
	<fieldset>
 		<legend><?php __('Add Milestone');?></legend>
	<?php
		echo $form->input('name' , array('label'=>'Milestone'));
		echo $form->input('startdate' , array('label'=>'Start Date'));
		echo $form->input('enddate' , array('label'=>'Due Date')); 
		echo $form->input('user_id' , array('label'=>'Owner'));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
	?>
	<label for="color">Color:</label><input type="text" id="color" name="data[Milestone][color]" value="#123456" /><div id="picker"></div>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
