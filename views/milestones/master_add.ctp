<div class="milestones form">
<?php echo $form->create('Milestone');?>
	<fieldset>
 		<legend><?php __('Add Milestone');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Milestones', true), array('action'=>'index'));?></li>
	</ul>
</div>
