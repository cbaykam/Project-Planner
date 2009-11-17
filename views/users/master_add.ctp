<div class="users form">
<?php echo $form->create('user');?>
	<fieldset>
 		<legend><?php __('Add user');?></legend>
	<?php
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
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('List users', true), array('action'=>'index'));?></li>
	</ul>
</div>
