<div id="pagetitle"><h1>Edit Status</h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Statuss' , array('url'=>array('controller'=>'statusses' , 'action'=>'edit' , 'master'=>true,$this->params["pass"][1])));?>
	<fieldset>
	<?php
		echo $form->input('id');
		echo $form->input('status');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>