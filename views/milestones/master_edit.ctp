<div id="pagetitle"><h1><?php __('Edit Milestone');?></h1></div>
<div id="projectLeftSide">
<?php echo $html->css('farbtastic' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<div class="milestones form">
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'edit','master'=>true, $this->params["pass"][1])));?>
	<fieldset>

	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('startdate' , array('label'=>'Start Date', 'dateFormat'=>'DMY'));
		echo $form->input('enddate' , array('label'=>'Due Date', 'dateFormat'=>'DMY'));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
	?>
	<?php echo $color->select($this->data["Milestone"]["color"]);?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

