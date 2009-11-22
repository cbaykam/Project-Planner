<?php
	
	class AppController extends Controller
	{  
	    var $helpers = array('Html' , 'Javascript', 'Time');
	    var $components = array('Auth' , 'Session');
	    var $uses = array('Project');
	    
		function beforeFilter()
	    {
	    	
	    	//set authentication fields for using email as username 
	    	$this->Auth->fields = array(
            	'username' => 'email',
            	'password' => 'password'
            );
            $this->Auth->loginRedirect = array('controller'=>'projects' , 'action'=>'index' , 'master'=>true);
            $this->Auth->logoutRedirect = array('controller'=>'users' , 'action'=>'login');
            //get projects 
             
            $this->__getProjects();
            	    
            //check if user is logged in 
            if ($this->Auth->user('id') != 0 )
            {
                if ($this->Auth->user('admin') == 1)
                {
                	$this->set("adminuser" , true);
                }
                else{
                	$this->set("adminuser" , false);
                }
                $this->set("authuser" , true);
            }
            else
            {
            	$this->set("authuser" , false);
            	$this->set("adminuser" , false);
            }	
            
	    }
	    
	    function __getProjects(){
	    	$this->set("projectsOpen" , $this->Project->find('all'));
	    }
	}
?>
