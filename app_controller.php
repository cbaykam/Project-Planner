<?php
	
	class AppController extends Controller
	{  
	    var $helpers = array('Html' , 'Javascript');
	    var $components = array('Acl' , 'Auth');
	    
		function beforeFilter()
	    {
	    	$this->Auth->fields = array(
            	'username' => 'email',
            	'password' => 'password'
            );
            $this->Auth->loginRedirect = array('controller'=>'projects' , 'action'=>'index');	    
            
            if ($this->Auth->user('id') != 0 )
            {
                $this->set("authuser" , true);
            }	
	    }
	}
?>
