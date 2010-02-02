<div class="notices form">
<?php echo $form->create('Notice' , array('url'=>array('controller'=>'notices' , 'action'=>'add','master'=>true , $this->params['pass'][0])));?>
	<fieldset>
 		<legend><?php __('Add Notice');?></legend>
	<?php
		echo $form->input('title', array('label'=>'Title'));
		echo $form->input('noticescol', array('label'=>'Message','type'=>'textfield'));
		echo $form->input('date');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
