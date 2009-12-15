<div class="milestones form">
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'edit','master'=>true, $this->params["pass"][1])));?>
	<fieldset>
 		<legend><?php __('Edit Milestone');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('enddate' , array('label'=>'Due Date'));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
		echo $form->input('key' , array('type'=>'select' , 'options'=>array('0'=>'No' , '1'=>'Yes') , 'label'=>'Is This a Key Milestone' ));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

