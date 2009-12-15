<?php
class MilestonesController extends AppController {

	var $name = 'Milestones';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Milestone->recursive = 0;
		$this->set('milestones', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		$this->set('milestone', $this->Milestone->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Milestone->create();
			if ($this->Milestone->save($this->data)) {
				$this->flash(__('Milestone saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Milestone->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Milestone->save($this->data)) {
				$this->flash(__('The Milestone has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Milestone->read(null, $id);
		}
		$projects = $this->Milestone->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if ($this->Milestone->del($id)) {
			$this->flash(__('Milestone deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Milestone->recursive = 0;
		$this->set('milestones', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		$this->set('milestone', $this->Milestone->read(null, $id));
	}

	function master_add($project) {
		$this->__checkadmin($project);
		if (!empty($this->data)) {
			$this->data["Milestone"]["project_id"] = $project;
			$this->Milestone->create();
			if ($this->Milestone->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
			} 
		}
		$users = $this->Milestone->User->find('list');
		$this->set(compact('users'));
	}

	function master_edit($id = null , $project) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->data["Milestone"]["project_id"] = $project;
			if ($this->Milestone->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view', 'master'=>true, $project));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Milestone->read(null, $id);
		}
	}

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if ($this->Milestone->del($id)) {
			$this->flash(__('Milestone deleted', true), array('action'=>'index'));
		}
	}
	
	function master_assign($milestone , $project){
		$this->__checkadmin($project);
		if (!empty($this->data))
		{
			$udat = $this->User->findById($this->data["Milestone"]["usersa"]);
			$this->Milestone->id = $milestone;
			$this->Milestone->saveField("user_id" , $this->data["Milestone"]["usersa"]);			
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) );
		}
	}
	
	function master_complete($milestone , $project){
		if (!empty($this->data))
		{
			$this->Milestone->id = $milestone;
			$this->Milestone->saveAll($this->data);
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) );
		}
		if (empty($this->data)) {
			$this->data = $this->Milestone->read(null, $milestone);
			$this->set("mil" , $this->data);
		}	
	}
	
	function master_standart(){
		$this->layout ='ajax';
	}

}
?>
