<?php echo $html->css('farbtastic' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('farbtastic' , false); ?>
<?php echo $javascript->link('fbts' , false); ?>
<div id="pagetitle"><h1><?php __('Add Standard Milestone');?></h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Standart');?>
	<fieldset>
	<?php
		echo $form->input('name');
	?>
	<?php echo $color->st();?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>