
 <?php if($this->params["pass"][0] == 1):?>
 	<div id="pagetitle"><h1><?php __('Add Customer');?></h1></div>
 <?php else:?>
 	<div id="pagetitle"><h1><?php __('Add Resource');?></h1></div>
 <?php endif;?>
 <div id="projectLeftSide">
<?php echo $form->create('User' , array('url'=>array('controller'=>'users' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0]) ));?>
	<fieldset>

 	
	<?php
		echo $form->input('name');
		echo $form->input('email');
		echo $form->input('password');
		echo $form->input('pwork' , array('label'=>'Phone') );
		echo $form->input('pmobile' ,array('label'=>'Mobile') );
		echo $form->input('messenger');
		echo $form->input('skype');
		if(isset($this->params["pass"][0])){
			echo $form->input('redalto' , array('type'=>'hidden' , 'value'=>'0' ) );
			echo $form->input('website');
		}else{
			echo $form->input('redalto' , array('type'=>'hidden' , 'value'=>'1' ) );
			echo $form->input('admin' , array('type'=>'select' , 'options'=>array('0'=>'No' , '1'=>'Yes') , 'label'=>'Admin Rights'));
		}
		
		
	?>
	</fieldset>
<?php echo $form->end('Submit');?>
	</div>
