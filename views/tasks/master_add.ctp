<div class="tasks form">
<?php echo $form->create('Task' , array('url'=>array('controller'=>'tasks' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0]) ) );?>
	<fieldset>
 		<legend><?php __('Add Task');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('priority' , array('type'=>'select', 'options'=>array('1'=>'High' , '2'=>'Medium' , '3'=>'low') ) );
		echo $form->input('status' , array('type'=>'select', 'options'=>array('0'=>'0%' , '10'=>'10%' , '20'=>'20%', '30'=>'30%', '40'=>'40%', '50'=>'50%', '60'=>'60%', '70'=>'70%', '80'=>'80%', '90'=>'90%', '100'=>'100%') ) );
		echo $form->input('description');
		echo $form->input('startdate');
		echo $form->input('duedate');
		if (!isset($this->params["pass"][1]))
		{
			echo $form->input('user_id' , array('label'=>'Resource' , 'empty'=>'(None)'));
		}
		echo $form->input('task_id' , array('label'=>'Dependency' , 'empty'=>'(None)'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>

