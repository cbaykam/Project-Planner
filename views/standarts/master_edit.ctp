<?php echo $html->css('farbtastic' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('farbtastic' , false); ?>
<?php echo $javascript->link('fbts' , false); ?>
<div class="standarts form">
<?php echo $form->create('Standart');?>
	<fieldset>
 		<legend><?php __('Edit Standard Milestone');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
	?>
	<label for="color">Color:</label><input type="text" id="color" name="data[Milestone][color]" value="<?php echo $this->data["Standart"]["color"]?>" /><div id="picker"></div>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>