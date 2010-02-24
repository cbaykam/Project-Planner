<div id="pagetitle"><h1><?php __('Add Milestone');?> </h1></div>
<div id="projectLeftSide">
<?php echo $html->css('farbtastic' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<div class="milestones form">
<?php echo $form->create('Milestone' , array('url'=>array('controller'=>'milestones' , 'action'=>'add','master'=>true , $this->params['pass'][0])));?>
	<fieldset>
	<?php
		echo $form->input('name' , array('label'=>'Milestone'));
		echo $form->input('startdate' , array('label'=>'Start Date', 'dateFormat'=>'DMY'));
		echo $form->input('enddate' , array('label'=>'Due Date', 'dateFormat'=>'DMY')); 
		echo $form->input('user_id' , array('label'=>'Owner'));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Yet Started'=>'Not Yet Started' , 'In Progress'=>'In Progress' , 'Done'=>'Done') ));
	?>
	<?php echo $color->select();?>
	</fieldset>
<input type="submit" value="Submit">
</div></div>
<div id="projectRightSide">
<?php echo $this->element('milestonefrom'); ?>
	</form>
</div>

