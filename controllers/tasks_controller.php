<?php
class TasksController extends AppController {

	var $name = 'Tasks';
	var $helpers = array('Html', 'Form');
	var $uses = array("Task" , "UsersProject" , "User" , "Project");

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
		$this->Task->recursive = 0;
		$this->set('tasks', $this->paginate());
	}

	function master_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		$this->set('task', $this->Task->read(null, $id));
	}

	function master_add($project=null , $user=null) {
		if (!empty($this->data)) {
			$this->data["Task"]["project_id"] = $project;
			if ($user){
				$this->data["Task"]["user_id"] = $user;
			}
			$this->data["Task"]["dependency"] = $this->data["Task"]["task_id"];
			$this->Task->create();
			if ($this->Task->save($this->data)) {
				$this->flash(__('Task saved.', true), array('controller'=>'projects', 'action'=>'view' , 'master'=>'true' , $project));
			} 
		}
		
		if ($user)
		{
			$this->set("user_id" , $user);
		}
		$resources = $this->Project->findById($project);
	
		$users = array();
		$i = 0;
		foreach ($resources["User"] as $res)
		{
			$users[$i]["name"] = $res["name"];
			$users[$i]["id"] = $res["id"];
			$i++;
		}
		$this->set("users" , $users);
		$tasks = $this->Task->find('list' , 
						array(
							'conditions'=>array(
								'Task.project_id'=>$project
							)	
		) );
		$this->set(compact('projects' , 'tasks'));
	}

	function master_edit($id = null) {
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

	function master_delete($id = null , $project) {
		if (!$id) {
			$this->flash(__('Invalid Task', true), array('action'=>'index'));
		}
		if ($this->Task->del($id)) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
		}
	}
	
	function master_assign($task , $project)
	{
		if (!empty($this->data))
		{
			$this->Task->id = $task;
			$this->Task->saveField("user_id" , $this->data["Task"]["usersa"]);
			//$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) );
			echo '<pre>';
				  print_r($this->data); 
			echo '</pre>';
		}
	}

}
?>
