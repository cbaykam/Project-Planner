<?php
	
	class AppController extends Controller
	{  
	    var $helpers = array('Html' , 'Javascript', 'Time' , 'Timecal' , 'Priority' , 'Text');
	    var $components = array('Auth' , 'Session' , 'Email');
	    var $uses = array('Project' , 'User' , 'Milestone' , 'Task');
	    
		function beforeFilter()
	    {
	    	// Dont use timeline for start
	    	$this->set("timeline" , false);
	    	$this->set("colorpicker" , false);
	    	$this->set('user_idd' , $this->Auth->user("id"));
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
	    
	    /*
	     * Check Admin Function 
	     * Checks if the user has admin rights on the project
	     * $project -> Is the id of the project
	     * $redir -> If redir is true script will redirect the user to the error page.  
	     */
	    
	    function __checkadmin($project = null , $redir = true){
	    	$admin = $this->Auth->user('admin');
	    	if ($project != null)
	    	{
	    		$this->Project->recursive = 2;
	        	$projdat = $this->Project->findById($project);	
	        	if ($admin)
	        	{
	        		$uid = $this->Auth->user('id');	
	        	}else{
	        		$uid = $projdat["Project"]["user_id"];
	        		$admin = 1;
	        	}	
	    	}else{
	    		$this->User->recursive = 2 ;
	    		if ($admin)
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
	    	if (!$admin || $uid != $this->Auth->user("id"))
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
	    
	    function __belongs($model , $user , $item , $redalto){
	    	$admin = $this->Auth->user('admin');
	    	if ($admin)
	    	{    	
	    		return true;
	    	}else
	    	{
	    		$dat = $this->$model->find('all', array(
	    								'conditions'=>array(
	    									'id'=>$item,
	    									'user_id'=>$user,
	    									'redalto'=>$redalto
	    								)
	    		) );
	    	
	    		if (count($dat) != 0)
	    		{	
	    			return true;
	    		}
	    		else{
	    			$this->cakeError("notadmin");
	    		}	
	    	}	    	
	    }
	    
	    function __timelineDate($date){
			$split = explode('-' , $date);
			$ret = $split[0].$split[1].$split[2];
			return $ret;
		}
		
		function __overdue($time){
			 if(strtotime($time) < time())
				 {
				 	return true; 				 	
				 }else
				 {
				 	return false;
				 }
		}
	    
	    function __calculatetime($hour , $minute){
			$duration = ($hour * 60) + $minute;
			return $duration;
		}
		
		function __milestoneComplete($tasks){
			
			foreach($milestones as $mile){
				
			}
		}
	}
?>
