<?php
	
	class AppController extends Controller
	{  
	    var $helpers = array('Html' , 'Javascript', 'Time' , 'Timecal' , 'Priority');
	    var $components = array('Auth' , 'Session');
	    var $uses = array('Project' , 'User');
	    
		function beforeFilter()
	    {
	    	
	    	//set authentication fields for using email as username 
	    	$this->Auth->fields = array(
            	'username' => 'email',
            	'password' => 'password'
            );
            //$this->Auth->loginRedirect = array('controller'=>'projects' , 'action'=>'index' , 'master'=>true);
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
	    
	    function __checkadmin($project = null , $redir = true){
	    	if ($project != null)
	    	{
	    		$this->Project->recursive = 2;
	        	$projdat = $this->Project->findById($project);	
	        	if ($this->Auth->user("admin"))
	        	{
	        		$uid = $this->Auth->user('id');	
	        	}else{
	        		$uid = $projdat["Project"]["user_id"];
	        	}	
	    	}else{
	    		$this->User->recursive = 2 ;
	    		if ($this->Auth->user("admin"))
	    		{	
	    			$uid = $this->Auth->user('id');
	    		}else{
					$adm = $this->User->find('first' , array(
				    							'conditions'=>array(
				    								'User.admin'=>1
				    							)
				    ));
					$uid = $adm["User"]["id"];
	    		}
	    	    
	    	}
	    	if (!$this->Auth->user("admin") || $uid != $this->Auth->user("id"))
	    	{
	    		if ($redir)
	    		{
	    			$this->cakeError("notadmin");
	    			
	    		}else
	    		{
	    			return false;
	    		}
	    			
	    	}else
	    	{
	    		return true;
	    	}
	    }
	    
	}
?>
