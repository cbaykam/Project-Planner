<div class="statusses form">
<?php echo $form->create('Statuss' , array('url'=>array('controller'=>'statusses' , 'action'=>'add','master'=>true , $this->params["pass"][0])));?>
	<fieldset>
 		<legend><?php __('Add Statuss');?></legend>
	<?php
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
