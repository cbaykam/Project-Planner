<div class="notices form">
<?php echo $form->create('Notice' , array('url'=>array('controller'=>'notices' , 'action'=>'add','master'=>true , $this->params['pass'][0])));?>
	<fieldset>
 		<legend><?php __('Add Notice');?></legend>
	<?php
		echo $form->input('noticescol', array('type'=>'textfield'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
