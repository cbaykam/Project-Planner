<?php
class TasksController extends AppController {

	var $name = 'Tasks';
	var $helpers = array('Html', 'Form' , 'Tsk');
	var $uses = array("Task" , "UsersProject" , "User" , "Project" , "Milestone");

	function index() {
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		$this->set('task', $this->Task->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Task->create();
			if ($this->Task->save($this->data)) {
				$this->flash(__('Task saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Task->Project->find('list');
		$resources = $this->Task->Resource->find('list');
		$this->set(compact('projects', 'resources'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Task->save($this->data)) {
				$this->flash(__('The Task has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Task->read(null, $id);
		}
		$projects = $this->Task->Project->find('list');
		$resources = $this->Task->Resource->find('list');
		$this->set(compact('projects','resources'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if ($this->Task->del($id)) {
			$this->flash(__('Task deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

	function master_view($id = null , $project) {
		
		$this->__checkadmin($project);
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
	
	function master_viewuser($user){
		//View task by resource 	
		// will add the user  verification $this->__checkadmin($project) is not a good solution for this.
		
		$this->set("tasks" , $this->Task->find('all' , 
										array(
										    'conditions'=>array(
										      "Task.user_id"=>$user,
										    )
										)
						));
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
	
	function master_add($project=null , $user=null , $formres = false) {
		$this->__checkadmin($project);
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			if ($this->data["Task"]["project_id"] == "")
			{
				$this->data["Task"]["project_id"] = $project;	
			}else{
				$project = $this->data["Task"]["project_id"];
			}
			
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			if ($user){
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
					if ($project)
					{
					 	$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
					}else{
						$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $this->data["Task"]["project_id"]));
					}
				}
				
			} 
		}
		// Find user If the user is set get user_id 
		if ($user)
		{
			// For the form if the user set.  
			$this->set("user_id" , $user);
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
		$projects = $this->Project->find('list');
		// Generate the lists 
		$this->set(compact('projects' , 'tasks' , 'milestones'));
	}

	function master_edit($id = null , $project) {
		$this->__checkadmin($project);
		if (!empty($this->data)) {
			$mail = false;
			// If no project is specified.
			
			$this->data["Task"]["project_id"] = $project;
			$this->data["Task"]["creator"] = $this->Auth->user("id");
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
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

	function master_delete($id = null , $project) {
		$this->__checkadmin($project);
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if ($this->Task->del($id)) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
		}
	}
	
	function master_complete($task=null , $project=null ){
		$this->__checkadmin($project);
		$data["Task"]["enddate"] = date("Y-m-d");
		$data["Task"]["status"] = 100;
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
	
	function deneme(){
		$this->__checkadmin();
		echo date('ym');
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

}
?>
