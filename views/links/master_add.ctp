<div class="links form">
<?php echo $form->create('Link' , array('url'=>array('controller'=>'links' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0]) ) );?>
	<fieldset>
 		<legend><?php __('Add Link');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('link');
	?>
	</fieldset>
<?php echo $form->end('Add Link');?>
</div>
