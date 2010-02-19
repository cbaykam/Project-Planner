<?php
class ActivitiesController extends AppController {

	var $name = 'Activities';
	var $helpers = array('Html', 'Form');
	var $uses = array('Activity' , 'Project');
	var $components = array('FileUpload');
	
	function beforeFilter(){
		parent::beforeFilter();
		$this->FileUpload->uploadDir = 'files';
	}
	
	function index() {
		$this->Activity->recursive = 0;
		$this->set('activities', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		$this->set('activity', $this->Activity->read(null, $id));
	}

	function add($task , $project=null , $user = null) {
		if($project == 0){
			$this->__belongs(false, null , 'Task' , $task);
		}else{
			$this->__belongs(true ,$project);
		}
		
		$this->set('projectid' , $project);
		if (!empty($this->data)) {
		    $this->data["Activity"]["task_id"] = $task;
		    $this->data["Activity"]["user_id"] = $user;
		    $this->data["Activity"]["duration"] = $this->__calculatetime($this->data["Activity"]["hour"] , $this->data["Activity"]["minute"]);
			$this->data["Activity"]["project_id"] = $project;
			$this->Activity->create();
			if ($this->Activity->save($this->data)) {
				$this->redirect(array('controller'=>'tasks' , 'action'=>'view' , $task , $project) );
			} else {
			}
		}
		$tasks = $this->Activity->Task->find('list');
		// fetch the users in the project 
		if($project != 0){
			$this->__usersin($project);	
		}
		
		$this->set(compact('tasks'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Activity->save($this->data)) {
				$this->flash(__('The Activity has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Activity->read(null, $id);
		}
		$tasks = $this->Activity->Task->find('list');
		$this->set(compact('tasks'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		if ($this->Activity->del($id)) {
			$this->flash(__('Activity deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Activity->recursive = 0;
		$this->set('activities', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		$this->set('activity', $this->Activity->read(null, $id));
	}

	function master_add($task , $project=null , $user = null) {
		$this->__checkadmin($project);
		$this->set('projectid' , $project);
		if (!empty($this->data)) {
			if($this->FileUpload->success){
				$this->data["Activity"]["file"] = $this->data["Activity"]["file"]["name"];
			}
		    $this->data["Activity"]["task_id"] = $task;
		    $this->data["Activity"]["user_id"] = $user;
		    $this->data["Activity"]["duration"] = $this->__calculatetime($this->data["Activity"]["hour"] , $this->data["Activity"]["minute"]);
			$this->data["Activity"]["project_id"] = $project;
			$this->Activity->create();
			if ($this->Activity->save($this->data)) {
				$this->redirect(array('controller'=>'tasks' , 'action'=>'view' , 'master'=>true , $task , $project) );
			} else {
			}
		}
		$tasks = $this->Activity->Task->find('list');
		// fetch the users in the project 
		if($project != 0){
			$this->__usersin($project);	
		}
		
		$this->set(compact('tasks'));
	}

	function master_edit($id = null , $task , $project=0) {
		$this->__checkadmin($project);
		$this->set("projectid" , $project);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->data["Activity"]["duration"] = $this->__calculatetime($this->data["Activity"]["hour"] , $this->data["Activity"]["minute"]);
			if ($this->Activity->save($this->data)) {
				$this->redirect(array('controller'=>'tasks' , 'action'=>'view' , 'master'=>true , $task , $project) );
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Activity->read(null, $id);
		}
		// fetch the users in the project 
		if($project != 0){
			$this->__usersin($project);	
		}
		$tasks = $this->Activity->Task->find('list');
		$this->set(compact('tasks'));
	}

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Activity', true), array('action'=>'index'));
		}
		if ($this->Activity->del($id)) {
			$this->flash(__('Activity deleted', true), array('action'=>'index'));
		}
	}
	
	function __usersin($project){
		$usersin = $this->Project->findById($project);
		$users = array();
		$i = 0;
		foreach ($usersin["User"] as $res)
		{
			$users[$i]["name"] = $res["name"];
			$users[$i]["id"] = $res["id"];
			$i++;
		}
		$this->set("users" , $users);
	}

}
?>
