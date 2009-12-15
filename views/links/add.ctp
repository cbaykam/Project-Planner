<div class="links form">
<?php echo $form->create('Link');?>
	<fieldset>
 		<legend><?php __('Add Link');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('link');
		echo $form->input('project_id');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List Links', true), array('action'=>'index'));?></li>
	</ul>
</div>
