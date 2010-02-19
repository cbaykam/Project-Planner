<div id="pagetitle"><h1><?php __('Add Link');?> </h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Link' , array('url'=>array('controller'=>'links' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0]) ) );?>
	<fieldset>

	<?php
		echo $form->input('name');
		echo $form->input('link');
	?>
	</fieldset>
<?php echo $form->end('Add Link');?>
</div>
