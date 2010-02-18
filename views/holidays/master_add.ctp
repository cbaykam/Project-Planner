<div class="holidays form">
<?php echo $form->create('Holiday' , array('url'=>array('controller'=>'holidays' , 'action'=>'add' , $this->params["pass"][0])) );?>
	<fieldset>
 		<legend><?php __('Add Holiday');?></legend>
	<?php
		echo $form->input('description');
		echo $form->input('start');
		echo $form->input('end');
		echo $form->input('type' , array('type'=>'select' , 'options'=>array('v'=>'Holiday / Vacation' , 'o'=>'Other') ) );
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
