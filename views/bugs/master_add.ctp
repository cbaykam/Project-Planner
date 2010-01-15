<div class="bugs form">
<?php echo $form->create('Bug' , array('url'=>array('controller'=>'bugs' , 'action'=>'add','master'=>true , $this->params["pass"][0])) );?>
	<fieldset>
 		<legend><?php __('Add Bug');?></legend>
	<?php
		echo $form->input('description' , array('type'=>'textfield') );
		echo $form->input('priority' , array('label'=>'Priority' , 'options'=>array('1'=>'High' , '2'=>'Normal' ,'3' => 'Low') ));
		echo $form->input('status' , array('type'=>'select' , 'options'=>array('Not Started'=>'Not Started' , 'In Progress'=>'In Progress' , 'OK'=>'OK') ) );
		echo $form->input('user_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
