<div class="tasks form">
<?php echo $form->create('Task' , array('url'=>array('controller'=>'tasks' , 'action'=>'add', $this->params["pass"][0] , $this->params["pass"][1], $this->params["pass"][2] , $this->params["pass"][3] , $this->params["pass"][4]) ) );?>
	<fieldset>
	 <?php if($buggie == 0):?>
 		<legend><?php __('Add Task');?></legend>
 	<?php else:?>
 		<legend><?php __('Create Job');?></legend>
	<?php endif;?>
	<?php
		echo $form->input('name');
		echo $form->input('priority' , array('type'=>'select', 'options'=>array('1'=>'High' , '2'=>'Medium' , '3'=>'low') ) );
		echo $form->input('status' , array('type'=>'select', 'options'=>array('0'=>'0%' , '10'=>'10%' , '20'=>'20%', '30'=>'30%', '40'=>'40%', '50'=>'50%', '60'=>'60%', '70'=>'70%', '80'=>'80%', '90'=>'90%', '100'=>'100%') ) );
		echo $form->input('description');
		echo $form->input('startdate' , array('label'=>'Start Date'));
		echo $form->input('duedate', array('label'=>'Due Date'));
		if ($this->params["pass"][1] == 0)
		{
			 echo '<label for="TaskUserId">Assign a Resource</label>'; 
		     echo '<select id="TaskUserId" name="data[Task][user_id]">
					<option value="">(None)</option>';
				foreach ($users as $usr)
				{
					echo '<option value="'. $usr["User"]["id"] .'">' . $usr["User"]["name"] . '</option>';
				}
			 echo '</select><br><br>';
		}else{
			echo $form->input('user_id', array('type'=>'hidden' , 'value'=>$this->params["pass"][1]));
		}
		
		
		
	?>
	
	<?php if ($this->params['pass'][0] == 0): ?>
		<?php if($buggie == 0):?>
			<?php echo $form->input('project_id'); ?>
		<?php else:?>
			<?php echo $form->input('project_id' , array('type'=>'hidden' , 'value'=>'0')); ?>
			<?php if ($this->params['pass'][4] == 0): ?>
				<?php echo $form->input('customer')?>
			<?php else:?>
				<?php echo $form->input('customer' , array('type'=>'hidden' , 'value'=>'redalto')); ?>
			<?php endif; ?>
			<?php echo $form->input('task_id' , array('type'=>'hidden' , 'value'=>'0')); ?>
		<?php endif;?>
	<?php else: ?>
		<?php echo $form->input('task_id' , array('label'=>'Dependency' , 'empty'=>'(None)')); ?>
		<?php echo $form->input('milestone_id' , array('label'=>'Project Phase')); ?>
	<?php endif; ?>
	</fieldset>
	<fieldset>
		<h3>Recurrance</h3>
			<?php echo $form->input('recursive' , array('type'=>'select' , 'options'=>array( "0"=>'no' , "1"=>'yes')))?>
			<?php echo $form->input('recduration' , array('label'=>'Duration (Days)'))?>
			How many Times will task repeat itself. (If you delete the main task it will stop repeating.)
			<br><br>
			<?php echo $form->input('rechowmany' , array('label'=>'How many times shall this task repeat'))?>
	</fieldset>
	<br><br>
<?php echo $form->end('Submit');?>
</div>