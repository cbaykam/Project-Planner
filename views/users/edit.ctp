<div class="users form">
<?php echo $form->create('user');?>
	<fieldset>
 		<legend><?php __('Edit user');?></legend>
	<?php
		echo $form->input('id');
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('pwork');
		echo $form->input('pmobile');
		echo $form->input('messenger');
		echo $form->input('skype');
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
<div>
	<pre>
	   <?php print_r($user); ?>
	</pre>
</div>
