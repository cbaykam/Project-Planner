<div class="milestones form">
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'add','master'=>true , $this->params['pass'][0])));?>
	<fieldset>
 		<legend><?php __('Add Milestone');?></legend>
	<?php
		echo $form->input('name' , array('label'=>'Milestone'));
		echo $form->input('enddate'); 
		echo $form->input('user_id');
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
		echo $form->input('key' , array('type'=>'select' , 'options'=>array('0'=>'No' , '1'=>'Yes') , 'label'=>'Is This a Key Milestone' ))
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
