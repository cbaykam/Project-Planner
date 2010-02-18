<div class="milestones form">
<h2>Complete Milestone : <?php echo $mil['Milestone']['name']; ?> For Project : <?php echo $mil["Project"]["name"]; ?></h2>
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'edit','master'=>true, $this->params["pass"][1])));?>
	<fieldset>
 		<legend><?php __('Edit Milestone');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('completed' , array('label'=>'Date Of Completion'));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
