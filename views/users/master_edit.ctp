<div class="users form">
<?php echo $form->create('user' , array('url'=>array('controller'=>'users' , 'action'=>'edit','master'=>true , $userDat["User"]["id"])) );?>
	<fieldset>
 		<legend><?php __('Edit user');?></legend>
	<?php
		echo $form->input('User.id' ,array('value'=>$userDat["User"]["id"]));
		echo $form->input('User.name' ,array('value'=>$userDat["User"]["name"], 'label'=>'Name'));
		echo $form->input('User.email' ,array('value'=>$userDat["User"]["email"]));
		echo $form->input('User.password' ,array('value'=>'', 'label'=>'Password'));
		echo $form->input('User.pwork' ,array('value'=>$userDat["User"]["pwork"], 'label'=>'Phone Work'));
		echo $form->input('User.pmobile' ,array('value'=>$userDat["User"]["pmobile"], 'label'=>'Mobile Phone'));
		echo $form->input('User.messenger' ,array('value'=>$userDat["User"]["messenger"] , 'label'=>'Messenger'));
		echo $form->input('User.skype' ,array('value'=>$userDat["User"]["skype"] , 'label'=>'Skype'));
		echo $form->input('User.admin' ,array('value'=>$userDat["User"]["admin"] , 'label'=>'Admin' , 'type'=>'select' , 'options'=>array('0'=>'No' , '1'=>'Yes')));
		if($userDat["User"]["redalto"] == 0){
			echo $form->input('User.website');
		}	
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
