<div id="pagetitle"><h1><?php __('Edit Task');?> </h1></div>
<div id="projectLeftSide">

<?php echo $form->create('Task' , array('url'=>array('controller'=>'tasks' , 'action'=>'edit', $this->params["pass"][1]) ) );?>
	<fieldset>
	<?php
		echo $form->input('id');	
		echo $form->input('name');
		echo $form->input('priority' , array('type'=>'select', 'options'=>array('1'=>'High' , '2'=>'Medium' , '3'=>'low') ) );
		echo $form->input('status' , array('type'=>'select', 'options'=>array('0'=>'0%' , '10'=>'10%' , '20'=>'20%', '30'=>'30%', '40'=>'40%', '50'=>'50%', '60'=>'60%', '70'=>'70%', '80'=>'80%', '90'=>'90%', '100'=>'100%') ) );
		echo $form->input('description');
		echo $form->input('startdate' , array('label'=>'Start Date', 'dateFormat'=>'DMY'));
		echo $form->input('duedate', array('label'=>'Due Date', 'dateFormat'=>'DMY'));
	?>
	
	<?php if ($this->params['pass'][0] == 0): ?>
		<?php echo $form->input('project_id'); ?>
	<?php else: ?>
		<?php echo $form->input('task_id' , array('label'=>'Dependency' , 'empty'=>'(None)')); ?>
		<?php echo $form->input('milestone_id' , array('label'=>'Project Phase', 'empty'=>'(None)')); ?>
	<?php endif; ?>
	</fieldset>
	<fieldset>
		<h3>Recurrence</h3>
			<?php echo $form->input('recursive' , array('type'=>'select' , 'options'=>array("0"=>'no' , "1"=>'yes', 'label'=>'Recurring?' )))?>
			<?php echo $form->input('recduration' , array('label'=>'Frequency' , 'type'=>'select' , 'options'=>array('7'=>'Weekly' , '30'=>'Monthly' , '365'=>'Yearly')))?>
			How many Times will task repeat itself. (If you delete the main task it will stop repeating.)
			<br><br>
			<?php echo $form->input('rechowmany' , array('label'=>'Number of recurrences'))?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
