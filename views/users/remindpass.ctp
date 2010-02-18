<h3>Please fill the for to retrieve your password via mail.</h3>
<?php
 echo $form->create('User', array('url'=>array('controller'=>'users' , 'action'=>'remindpass')));
 echo $form->input('username' , array('label'=>'E-mail Address'));
 echo $form->end('Submit');
?>