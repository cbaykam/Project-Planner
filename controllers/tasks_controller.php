<?php
App::import('Vendor', 'timecalc');
class TasksController extends AppController {

	var $name = 'Tasks';
	var $helpers = array('Html', 'Form' , 'Tsk' , 'Priority' , 'Text');
	var $uses = array("Task" , "UsersProject" , "User" , "Project" , "Milestone");

	function beforeFilter(){
		parent::beforeFilter();
		$this->Auth->allowedActions = array('crontask');
	}
	
	function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}
	

	function complete($task=null , $project=null){
		$this->__belongs(true , $project);
		$data["Task"]["enddate"] = date("Y-m-d");
		$data["Task"]["status"] = 100;
		$data["Task"]["completed"] = '1' ;
		$this->Task->id = $task;
		$this->Task->save($data);
		$this->redirect(array('controller'=>'projects' , 'action'=>'view' , $project));
	}
	
	function uncomplete($task=null , $project=null ){
		$data["Task"]["enddate"] = '0000-00-00';
		$data["Task"]["completed"] = '0' ;
		$this->Task->id = $task;
		$this->Task->save($data);
		$this->redirect(array('controller'=>'projects' , 'action'=>'view', $project));
	}

	function view($id = null , $project=0) {
		
		$this->__belongs(false , null , 'Task' , $id);
		$this->set('projectid' , $project);
		if ($id)
		{
			$this->Task->recursive = 1 ;
			$tdata = $this->Task->findById($id);
			
			if ($tdata["Task"]["dependency"] != 0)
			{
				$this->Task->recursive = 0 ; 
				$dependent = $this->Task->findById($tdata["Task"]["dependency"]);	
				$this->set("depend" , $dependent);
			}else
			{
				$this->set("depend" , false);
			}
			$this->set("task" , $tdata);
		}else{
			$this->setFlash("Could Not Find the Task With Specified ID .");
		}
	}
	
	function add($project=0 , $user=0 , $formres = 0 , $bug = 0 , $bredalto = 0) {
		$this->set('buggie' , $bug);
		if (!empty($this->data)) {
			$mail = false;
			
			if($bug == 1){
				 if($bredalto == 1){
				 	$this->data["Task"]["type"] = 'redalto';	
				 }else{
				 	$this->data["Task"]["type"] = 'customer';
				 }
				
			}
			// If no project is specified.
			if ($this->data["Task"]["project_id"] == "")
			{
				$this->data["Task"]["project_id"] = $project;	
			}else{
				$project = $this->data["Task"]["project_id"];
			}
			
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			if ($user != 0){
				$this->data["Task"]["user_id"] = $user;
				$mail = true;
				$udat = $this->User->findById($user);
			}
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
			$date = date('yd');
			$this->data["Task"]["id"] = $date."-".$project."-" . $this->__slicetask($project);
			$this->data["Task"]["time"] = time();
			$this->Task->create();
			if ($this->Task->save($this->data)) {
				if ($mail)
				{
					$this->__eTaskNotification($udat['User']['email']);
				}
				//redirection part
				if ($formres == 1)
				{
					$this->redirect(array('controller'=>'tasks' , 'action'=>'viewuser', $user));
				}else
				{
					//if we have a project
					if ($project != 0)
					{
					 	$this->redirect(array('controller'=>'projects' , 'action'=>'view' , $project));
					}else if($bug == 1){
						if($bredalto == 1){
							$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs', 1));
						}else{
							$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs', 0));
						}
						
					}else{
						$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $this->data["Task"]["project_id"]));
					}
				}
				
			} 
		}
		//if this is a bug select customers 
			/*if($bug == 1){
				$this->set('customers' , $this->User->find('all' , array(
										'conditions'=>array(
											"User.redalto"=>0
										)
				)));
			}*/
		// Find user If the user is set get user_id 
		if ($user != 0)
		{
			// For the form if the user set.  
			$this->set("user_id" , $user);
		}
		// Fetching the project data will get the users too . 
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		if($project != 0){
			$users = array();
			$i = 0;
			foreach ($resources["User"] as $res)
			{
				$users[$i]["User"]["name"] = $res["name"];
				$users[$i]["User"]["id"] = $res["id"];
				$i++;
			}
			$this->set("users" , $users);
		}else{
			$this->set('users' , $this->User->find('all'));
		}
			
		//For setting the task dependency. 
		$tasks = $this->Task->find('list' , 
						array(
							'conditions'=>array(
								'Task.project_id'=>$project
							)	
		) );
		// Set the milestones. To generate the lists. 
		$milestones = $this->Milestone->find('list' , 
						array(
							'conditions'=>array(
								'project_id'=>$project
							)
						) 
		);
		// get the list of projects
		$projects = $this->Project->find('list' , array('conditions' => array('Project.id'=>$this->__fetchProjects())));
		// Generate the lists
		$this->set(compact('projects' , 'tasks' , 'milestones'));
	}

	

	function edit($id , $project) {
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		
			$users = array();
			$i = 0;
			foreach ($resources["User"] as $res)
			{
				$users[$i]["User"]["name"] = $res["name"];
				$users[$i]["User"]["id"] = $res["id"];
				$i++;
			}
			$this->set("users" , $users);
		
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			
			$this->data["Task"]["project_id"] = $project;
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
			if($this->data["Task"]["status"] == 100){
				$this->data["Task"]["completed"] = 1;
			}
			$date = date('yd');
			$this->data["Task"]["time"] = time();
			$this->Task->id = $this->data["Task"]["id"];
			if ($this->Task->save($this->data)) {
				//redirection part
				$this->redirect(array('controller'=>'projects', 'action'=>'view', $project));
				
			} 
		}
		
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}

		// Fetching the project data will get the users too . 
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		$users = array();
		$i = 0;
		foreach ($resources["User"] as $res)
		{
			$users[$i]["name"] = $res["name"];
			$users[$i]["id"] = $res["id"];
			$i++;
		}
		$this->set("users" , $users);
		//For setting the task dependency. 
		$tasks = $this->Task->find('list' , 
						array(
							'conditions'=>array(
								'Task.project_id'=>$project
							)	
		) );
		// Set the milestones. To generate the lists. 
		$milestones = $this->Milestone->find('list' , 
						array(
							'conditions'=>array(
								'project_id'=>$project
							)
						) 
		);
		// get the list of projects
		$this->set(compact('tasks' , 'milestones'));
	}
	
	function jobedit($id,$redalto){
		$this->__belongs(false, null, "Task" ,$id);
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			
			$this->data["Task"]["project_id"] = 0;
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			if($this->data["Task"]["status"] == 100){
				$this->data["Task"]["completed"] = 1;
			}
			$date = date('yd');
			$this->data["Task"]["time"] = time();
			$this->Task->id = $this->data["Task"]["id"];
			if ($this->Task->save($this->data)) {
				//redirection part
				$this->redirect(array('controller'=>'tasks', 'action'=>'indexjobs',  $redalto));
				
			} 
		}
		
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}

		// Fetching the project data will get the users too . 
		$resources = $this->User->find('all' , array(
									'conditions'=>array(
										'User.redalto'=>1
									)
		));
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		$users = array();
		$i = 0;
		foreach ($resources as $res)
		{
			$users[$i]["name"] = $res["User"]["name"];
			$users[$i]["id"] = $res["User"]["id"];
			$i++;
		}
		$this->set("users" , $users);
		// get the list of projects
		$this->set(compact('tasks' , 'milestones'));
	}
	
	function viewuser($user){
		//View task by resource 	
		// will add the user  verification $this->__checkadmin($project) is not a good solution for this.
		$this->__belongs(false , null , 'User' , $user);
		$this->set("tasks" , $this->Task->find('all' , 
										array(
										    'conditions'=>array(
										      "Task.user_id"=>$user,
											  'Task.type'=> null
										    )
										)
						));
		
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if ($this->Task->del($id)) {
			$this->flash(__('Task deleted', true), array('action'=>'index'));
		}
	}
	
	function viewcompleted($project){
		$this->set('data' , $this->Task->find('all' , array(
										'conditions'=>array(
											'Task.project_id'=>$project,
											'NOT'=>array(
												'Task.enddate'=>'0000-00-00'
											)	
										)
		)));
		
		$this->set('project' , $project);
	}
	
	function indexjobs($redalto = 0){
		if($redalto != 0){
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'redalto',
							'Task.user_id'=>$this->Auth->user("id")
						)
			);
		}else{
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'customer',
							'Task.user_id'=>$this->Auth->user("id")
						)
			);
		}
		$this->set('tasks', $this->paginate());
		$this->set('redalto' , $redalto);
	}


	function master_index() {
		$this->__checkadmin();
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

	function master_viewcompleted($project){
		$this->__checkadmin($project);
		$this->set('data' , $this->Task->find('all' , array(
										'conditions'=>array(
											'Task.project_id'=>$project,
											'NOT'=>array(
												'Task.enddate'=>'0000-00-00'
											)	
										)
		)));
		
		$this->set('project' , $project);
	}
	
	function master_completejob($task=null , $redalto = 0){
		$this->__checkadmin($project);
		$this->set('tdata', $this->Task->findById($task));
		$this->set('pdata' , $this->Project->findById($project));
		$this->set('redalto' , $redalto);
		if(!empty($this->data)){
			$this->data["Task"]["status"] = 100;
			$this->data["Task"]["completed"] = '1' ;
			$this->Task->save($this->data);
			$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs' , $redalto));	
		}
		
	}
	
	function master_uncompletejob($task=null , $redalto ){
		$this->__checkadmin($project);
		$data["Task"]["enddate"] = '0000-00-00';
		$data["Task"]["completed"] = '0' ;
		$this->Task->id = $task;
		$this->Task->save($data);
		$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs' , $redalto));	
	}
	
	function master_view($id = null , $project=0) {
		
		$this->__checkadmin($project);
		$this->set('projectid' , $project);
		
		if($project != 0){
			$this->set('projj' , $this->Project->findById($project));
		}
		
		if ($id)
		{
			$this->Task->recursive = 1 ;
			$tdata = $this->Task->findById($id);
			
			if ($tdata["Task"]["dependency"] != 0)
			{
				$this->Task->recursive = 0 ; 
				$dependent = $this->Task->findById($tdata["Task"]["dependency"]);	
				$this->set("depend" , $dependent);
			}else
			{
				$this->set("depend" , false);
			}
			$this->set("task" , $tdata);
		}else{
			$this->setFlash("Could Not Find the Task With Specified ID .");
		}
	}
	
	function master_viewuser($user , $project){
		//View task by resource 	
		// will add the user  verification $this->__checkadmin($project) is not a good solution for this.
		$this->__checkadmin($project);
		$this->set('projectIdd' , $project);
		$this->set("tasks" , $this->Task->find('all' , 
										array(
										    'conditions'=>array(
										      "Task.user_id"=>$user
										    )
										)
						));
		
	}
	
	function master_indexjobs($redalto = 0){
		$this->__checkadmin();
		if($redalto != 0){
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'redalto',
							'Task.completed'=>'0'
						)
			);
		}else{
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'customer',
							'Task.completed'=>'0'
						)
			);
		}
		$this->set('tasks', $this->paginate());
		$this->set('redalto' , $redalto);
	}
	
	function master_jobscompleted($redalto = 0){
		$this->__checkadmin();
		if($redalto != 0){
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'redalto',
							'Task.completed'=>'1'
						)
			);
		}else{
			$this->paginate = array(
						'conditions'=>array(
							'Task.type'=>'customer',
							'Task.completed'=>'1'
						)
			);
		}
		$this->set('tasks', $this->paginate());
		$this->set('redalto' , $redalto);
	}
	
	function master_redaltoapprove($id){
		$this->Task->id = $id;
		$this->Task->saveField('approved' , 1);
		$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs' , 'master'=>true ,1));
	}

	/*
	*
	* Adding a task  
	* params : project int  -> Project id 
	*          user    int  -> Userid
	*          fromres bool -> where to return 
	* 
	* If fromres = true after adding it will redirect to resource else to the project
	**/
	
	function master_add($project=0 , $user=0 , $formres = 0 , $bug = 0 , $bredalto = 0 , $milestone=0) {
		$this->__checkadmin($project);
		$this->set('project_idd' , $project);
		$this->set('buggie' , $bug);
		if($milestone != 0){
	         $this->set('milestoneid' , $milestone);
		}
		if (!empty($this->data)) {
			$mail = false;
			
			if($bug == 1){
				 if($bredalto == 1){
				 	$this->data["Task"]["type"] = 'redalto';	
				 }else{
				 	$this->data["Task"]["type"] = 'customer';
				 }
				
			}
			
			if($this->data["Task"]["recursive"] == 1){
				$this->data["Task"]["name"] = $this->data["Task"]["name"] . ' [recurring]';
			}
			// If no project is specified.
			if ($this->data["Task"]["project_id"] == "")
			{
				$this->data["Task"]["project_id"] = $project;	
			}else{
				$project = $this->data["Task"]["project_id"];
			}
			
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			if ($user != 0){
				$this->data["Task"]["user_id"] = $user;
				$mail = true;
				$udat = $this->User->findById($user);
			}
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
			$date = date('yd');
			$this->data["Task"]["id"] = $date."-".$project."-" . $this->__slicetask($project);
			$this->data["Task"]["time"] = time();
			$this->Task->create();
			if ($this->Task->save($this->data)) {
				if ($mail)
				{
					$this->__eTaskNotification($udat['User']['email']);
				}
				//redirection part
				if ($formres == 1)
				{
					$this->redirect(array('controller'=>'tasks' , 'action'=>'viewuser','master'=>true , $user));
				}else
				{
					//if we have a project
					if ($project != 0)
					{
					 	$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
					}else if($bug == 1){
						if($bredalto == 1){
							$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs','master'=>true , 1));
						}else{
							$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs','master'=>true , 0));
						}
						
					}else{
						$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $this->data["Task"]["project_id"]));
					}
				}
				
			} 
		}
		//if this is a bug select customers 
			/*if($bug == 1){
				$this->set('customers' , $this->User->find('all' , array(
										'conditions'=>array(
											"User.redalto"=>0
										)
				)));
			}*/
		// Find user If the user is set get user_id 
		if ($user != 0)
		{
			// For the form if the user set.  
			$this->set("user_id" , $user);
		}
		// Fetching the project data will get the users too . 
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		if($project != 0){
			$users = array();
			$i = 0;
			foreach ($resources["User"] as $res)
			{
				$users[$i]["User"]["name"] = $res["name"];
				$users[$i]["User"]["id"] = $res["id"];
				$i++;
			}
			$this->set("users" , $users);
		}else{
			$this->set('users' , $this->User->find('all' , array('conditions'=>array('User.redalto'=>'1'))));
		}
			
		//For setting the task dependency. 
		$tasks = $this->Task->find('list' , 
						array(
							'conditions'=>array(
								'Task.project_id'=>$project
							)	
		) );
		// Set the milestones. To generate the lists. 
		$milestones = $this->Milestone->find('list' , 
						array(
							'conditions'=>array(
								'project_id'=>$project
							)
						) 
		);
		// get the list of projects
		$projects = $this->Project->find('list');
		// Generate the lists 
		$this->set(compact('projects' , 'tasks' , 'milestones'));
	}
	
	function master_recur(){
		$this->set('data' ,$this->Task->find('all' , array('conditions'=>array('Task.recursive' => '1' ))));
	}

	function master_edit($id = null , $project) {
		$this->__checkadmin($project);
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		
			$users = array();
			$i = 0;
			foreach ($resources["User"] as $res)
			{
				$users[$i]["User"]["name"] = $res["name"];
				$users[$i]["User"]["id"] = $res["id"];
				$i++;
			}
			$this->set("users" , $users);
		
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			
			$this->data["Task"]["project_id"] = $project;
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
			if($this->data["Task"]["status"] == 100){
				$this->data["Task"]["completed"] = 1;
			}
			$date = date('yd');
			$this->data["Task"]["time"] = time();
			$this->Task->id = $this->data["Task"]["id"];
			if ($this->Task->save($this->data)) {
				//redirection part
				$this->redirect(array('controller'=>'projects', 'action'=>'view', 'master'=>true, $project));
				
			} 
		}
		
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}

		// Fetching the project data will get the users too . 
		$resources = $this->Project->findById($project);
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		$users = array();
		$i = 0;
		foreach ($resources["User"] as $res)
		{
			$users[$i]["name"] = $res["name"];
			$users[$i]["id"] = $res["id"];
			$i++;
		}
		$this->set("users" , $users);
		//For setting the task dependency. 
		$tasks = $this->Task->find('list' , 
						array(
							'conditions'=>array(
								'Task.project_id'=>$project
							)	
		) );
		// Set the milestones. To generate the lists. 
		$milestones = $this->Milestone->find('list' , 
						array(
							'conditions'=>array(
								'project_id'=>$project
							)
						) 
		);
		// get the list of projects
		$this->set(compact('tasks' , 'milestones'));
		
	}
	
	function master_jobedit($id,$redalto){
		$this->__checkadmin();
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			
			$this->data["Task"]["project_id"] = 0;
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			if($this->data["Task"]["status"] == 100){
				$this->data["Task"]["completed"] = 1;
			}
			$date = date('yd');
			$this->data["Task"]["time"] = time();
			$this->Task->id = $this->data["Task"]["id"];
			if ($this->Task->save($this->data)) {
				//redirection part
				$this->redirect(array('controller'=>'tasks', 'action'=>'indexjobs', 'master'=>true, $redalto));
				
			} 
		}
		
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}

		// Fetching the project data will get the users too . 
		$resources = $this->User->find('all' , array(
									'conditions'=>array(
										'User.redalto'=>1
									)
		));
		
		// Setting the user data. Gets all the users in the project and generates a Select box.  
		$users = array();
		$i = 0;
		foreach ($resources as $res)
		{
			$users[$i]["name"] = $res["User"]["name"];
			$users[$i]["id"] = $res["User"]["id"];
			$i++;
		}
		$this->set("users" , $users);
		// get the list of projects
		$this->set(compact('tasks' , 'milestones'));
	}

	function master_delete($id = null , $project , $redalto = 0) {
		$this->__checkadmin($project);
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if ($this->Task->del($id)) {
			if($project == 0){
					$this->redirect(array('controller'=>'tasks' , 'action'=>'indexjobs' , 'master'=>true , $redalto));	
			}else{
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
			}
			
		}
	}
	
	function master_complete($task=null , $project=null ){
		$this->__checkadmin($project);
		$this->set('tdata', $this->Task->findById($task));
		$this->set('pdata' , $this->Project->findById($project));
		if(!empty($this->data)){
			$this->data["Task"]["status"] = 100;
			$this->data["Task"]["completed"] = '1' ;
			$this->Task->save($this->data);
			$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
		}	
	}
	
	function master_uncomplete($task=null , $project=null ){
		$this->__checkadmin($project);
		$data["Task"]["enddate"] = '0000-00-00';
		$data["Task"]["completed"] = '0' ;
		$this->Task->id = $task;
		$this->Task->save($data);
		$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
	}
	
	function master_assign($task , $project)
	{
		$this->__checkadmin($project);
		if (!empty($this->data))
		{
			$udat = $this->User->findById($this->data["Task"]["usersa"]);
			$this->Task->id = $task;
			if($this->Task->saveField("user_id" , $this->data["Task"]["usersa"])){
				$this->__eTaskNotification($udat['User']['email']);
			}
			
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) );
		}
	}
	
	function __slicetask($project){
		$data = $this->Task->find('all', array(
								'conditions'=>array(
									'Task.project_id'=>$project
								),
								'order'=>array(
									'Task.time Desc'
								),
								'limit'=>1
		));
		
		if (count($data) == 0)
		{
			return '01';
		}else{
			$slice = explode('-' , $data[0]["Task"]["id"]);
		    $num = (int)$slice[2];
		    $num++;
		    if ($num < 10)
		    {
		    	$num = '0' . $num ; 
		    }
		    return $num;
		}
		
		
	}
	
	function __eTaskNotification($email){
		$this->Email->from    = 'Redalto <project@redalto.com>';
		$this->Email->to      = $email;
		$this->Email->subject = 'You Have been Assigned To A Task';
		$message = 'You Are now working on another project please view.';
		$this->Email->send($message);
	}
	
	function __calcDuration($task){
		$sum = 0;
		foreach ($task["Activity"] as $activity)
		{
			$sum = $sum + $activity['duration'];
		}
		return $sum;
	}
	
	function crontask(){
		
		$this->layout = null;
		$this->Task->recursive = 0 ;
		$recursives = $this->Task->find('all' , 
							array(
								'conditions'=>array(
										'Task.recursive'=>'1'	
								)			
							)
		);
		
		foreach($recursives as $rec){
			
			if($rec["Task"]["rectimesrun"] < $rec["Task"]["rechowmany"]){
				if($this->__calcLastRun($rec["Task"]["lastrun"] ,$rec["Task"]["recduration"] )){
					$timecal = new timecalc;
					$project = $rec["Task"]["project_id"];
					$duration = $rec["Task"]["recduration"];
					$recdata["Task"]["project_id"] = $project;
					$date = date('yd');
					$recdata["Task"]["id"] = $date."-".$project."-" . $this->__slicetask($project);
					$recdata["Task"]["startdate"] = date("Y-m-d");
					$recdata["Task"]["duedate"] = $timecal->addDays($duration , "Y-m-d");
					$recdata["Task"]["user_id"] = $rec["Task"]["user_id"];
					$recdata["Task"]["name"] = $rec["Task"]["name"] ."[recurring]";
					$recdata["Task"]["priority"] = $rec["Task"]["priority"];
					$recdata["Task"]["type"] = $rec["Task"]["type"];
					$recdata["Task"]["description"] = $rec["Task"]["description"];
					$recdata["Task"]["milestone_id"] = $rec["Task"]["milestone_id"];
					$recdata["Task"]["customer"] = $rec["Task"]["customer"];
					$recdata["Task"]["approved"] = $rec["Task"]["approved"];
					$recdata["Task"]["creator"] = $rec["Task"]["creator"];
					$recdata["Task"]["status"] = 0;
					$recdata["Task"]["time"] = time();
					$this->Task->create();
					$this->Task->save($recdata);
					unset($recdata);
					$newrec = $rec["Task"]["rectimesrun"] + 1 ;
					$this->Task->id = $rec["Task"]["id"];
					$this->Task->saveField('rectimesrun' , $newrec);
					$this->Task->saveField('lastrun' , time());
				}
				
			}
			
		}
	}
	
	/* 
	 * This function calculates the if the cron tas shall run again or not. 
	 * */
	
	function __calcLastRun($lastrun , $days){
		$dur = $days * 86400;
		$dur = $dur + $lastrun;
		
		if($dur < time()){
			return true;
		}else{
			return false;
		}
	}

}
?>
