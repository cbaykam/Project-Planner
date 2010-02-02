<div class="notices form">
<?php echo $form->create('Notice');?>
	<fieldset>
 		<legend><?php __('Edit Notice');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('title' , array('label'=>'Title'));
		echo $form->input('noticescol' , array('label'=>'Message'));
		echo $form->input('date');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
