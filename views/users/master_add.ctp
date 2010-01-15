<div class="users form">
<?php echo $form->create('User' , array('url'=>array('controller'=>'users' , 'action'=>'add' , 'master'=>true) ));?>
	<fieldset>
 		<legend><?php __('Add user');?></legend>
	<?php
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('pwork' , array('label'=>'Phone') );
		echo $form->input('pmobile' ,array('label'=>'Mobile') );
		echo $form->input('messenger');
		echo $form->input('skype');
		echo $form->input('redalto' , array('label'=>'Customer or Resource' , 'type'=>'select' , 'options'=>array('1'=>'Resource' , '2'=>'Customer' ) ) );
		echo $form->input('admin' , array('type'=>'select' , 'options'=>array('0'=>'No' , '1'=>'Yes') , 'label'=>'User Admin'));
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
