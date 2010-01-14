<div class="tasks form">
<?php echo $form->create('Task' , array('url'=>array('controller'=>'tasks' , 'action'=>'edit' , 'master'=>true , $this->params["pass"][1]) ) );?>
	<fieldset>
 		<legend><?php __('Edit Task');?></legend>
	<?php
		echo $form->input('id');	
		echo $form->input('name');
		echo $form->input('priority' , array('type'=>'select', 'options'=>array('1'=>'High' , '2'=>'Medium' , '3'=>'low') ) );
		echo $form->input('status' , array('type'=>'select', 'options'=>array('0'=>'0%' , '10'=>'10%' , '20'=>'20%', '30'=>'30%', '40'=>'40%', '50'=>'50%', '60'=>'60%', '70'=>'70%', '80'=>'80%', '90'=>'90%', '100'=>'100%') ) );
		echo $form->input('description');
		echo $form->input('startdate');
		echo $form->input('duedate');
		
			 echo '<label for="TaskUserId">Please Select A User for the task</label>'; 
		     echo '<select id="TaskUserId" name="data[Task][user_id]">
					<option value="">(None)</option>';
				foreach ($users as $usr)
				{
					if ($usr["id"] == $this->data["Task"]["user_id"])
					{
						echo '<option selected value="'. $usr["id"] .'">' . $usr["name"] . '</option>';
					}else
					{
						echo '<option value="'. $usr["id"] .'">' . $usr["name"] . '</option>';
					}
					
				}
			 echo '</select><br><br>';
	?>
	
	<?php if ($this->params['pass'][0] == 0): ?>
		<?php echo $form->input('project_id'); ?>
	<?php else: ?>
		<?php echo $form->input('task_id' , array('label'=>'Dependency' , 'empty'=>'(None)')); ?>
		<?php echo $form->input('milestone_id' , array('label'=>'Project Phase', 'empty'=>'(None)')); ?>
	<?php endif; ?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
