<div id="pagetitle"><h1>
	<?php if($buggie == 0):?>
		<?php __('Add Task');?>
	<?php else:?>
		<?php __('Create Job');?>
	<?php endif;?>
</h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Task' , array('url'=>array('controller'=>'tasks' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0] , $this->params["pass"][1], $this->params["pass"][2] , $this->params["pass"][3] , $this->params["pass"][4]) ) );?>
	<fieldset>
	<?php
		if($buggie == 0){
			echo $form->input('milestone_id' , array('label'=>'Project Phase' , 'value'=>$milestoneid));
		}	
		echo $form->input('name');
		echo $form->input('priority' , array('type'=>'select', 'options'=>array('1'=>'High' , '2'=>'Medium' , '3'=>'low') , 'selected'=>'2' ) );
		echo $form->input('status' , array('type'=>'hidden', 'value'=>'0'));
		echo $form->input('description');
		echo $form->input('startdate' , array('label'=>'Start Date' , 'dateFormat'=>'DMY'));
		echo $form->input('duedate', array('label'=>'Due Date', 'dateFormat'=>'DMY'));
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
		
	<?php endif; ?>
	</fieldset>
	<fieldset>
		<h3>Recurrence</h3>
			<?php echo $form->input('recursive' , array('type'=>'select','label'=>'Recurring?' , 'options'=>array("0"=>'no' , "1"=>'yes')))?>
			<?php echo $form->input('recduration' , array('label'=>'Frequency', 'type'=>'select' , 'options'=>array('7'=>'Weekly' , '30'=>'Monthly' , '365'=>'Yearly')))?>
			How many Times will task repeat itself. (If you delete the main task it will stop repeating.)
			<br><br>
			<?php echo $form->input('rechowmany' , array('label'=>'Number of recurrences'))?>
	</fieldset>
	<br><br>
<?php echo $form->end('Submit');?>
<?php echo $html->link('cancel' , array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project_idd));?>
</div>