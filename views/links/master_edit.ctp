<div class="links form">
<?php echo $form->create('Link' , array('url'=>array('controller'=>'links' , 'action'=>'edit' , 'master'=>true , $this->params["pass"][1]) ) );?>
	<fieldset>
 		<legend><?php __('Edit Link');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('link');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
