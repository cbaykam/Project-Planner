<div id="projectLeftSide">
<?php
    $session->flash('auth');
    echo $form->create('User', array('action' => 'login'));
    echo $form->input('email');
    echo $form->input('password');
    echo $form->end('Login');
    echo $html->link('Forgot Password', array('controller'=>'users' , 'action'=>'remindpass'));
?>
</div>