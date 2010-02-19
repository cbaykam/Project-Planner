<div id="pagetitle"><h1><?php __('Add Status');?> </h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Statuss' , array('url'=>array('controller'=>'statusses' , 'action'=>'add','master'=>true , $this->params["pass"][0])));?>
	<fieldset>

	<?php
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
