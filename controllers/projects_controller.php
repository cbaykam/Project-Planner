<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form' , 'Priority');
	var $uses = array('Project' , 'User' , 'UsersProject' , 'Task');
	
	function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
        $this->set("users" , $this->User->find('all'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->flash(__('Project saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->flash(__('The Project has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if ($this->Project->del($id)) {
			$this->flash(__('Project deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$prdat = $this->Project->read(null, $id);
		$this->set('project', $prdat);
        $this->set("users" , $this->User->find('list'));
        $this->Task->recursive = 1;
        $this->set("tasks" , $this->Task->find('all' , array(
        										'conditions'=>array(
        											'Task.project_id'=>$id
        										)
        ) ));
       
		$usersa = array();
		$i = 0;
		foreach ($prdat["User"] as $res)
		{
			$usersa[$i]['name'] = $res["name"];
			$usersa[$i]['id'] = $res["id"];
			$i++;
		}
		
		$this->set(compact('usersa'));
		
	}

	function master_add() {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->flash(__('Project saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function master_edit($id = null) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->flash(__('The Project has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if ($this->Project->del($id)) {
			$this->flash(__('Project deleted', true), array('action'=>'index'));
		}
	}
	
	/*function master_adduser($project){
		
		if (!empty($this->data))
		{
		
		  $this->UsersProject->find('all' , array(
		  							'conditions'=>array(
		  								'UsersProject.user_id'=>$this->data
		  							)
		  ));
		  $this->data["UsersProject"][]
		  $this->Project->create();
		   if ($this->Project->save($this->data))
		   {
		   		//$this->redirect(array('controller'=>'projects' , 'action'=>'view' , $project));
		   }
		}
	}*/

}
?>
