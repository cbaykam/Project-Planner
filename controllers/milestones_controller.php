<?php
class MilestonesController extends AppController {

	var $name = 'Milestones';
	var $helpers = array('Html', 'Form', 'Color', 'Tsk');
	var $uses = array('Milestone' , 'Task');

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

	function edit($id = null , $project) {
		$this->__belongs(false , null , 'Milestone' , $id , false);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->data["Milestone"]["project_id"] = $project;
			if ($this->Milestone->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view', $project));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Milestone->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if ($this->Milestone->del($id)) {
			$this->flash(__('Milestone deleted', true), array('action'=>'index'));
		}
	}


	function master_index($project) {
		$this->__checkadmin();
		$this->Milestone->recursive = 0;
		$this->paginate = array(
				'conditions'=>array(
					'Milestone.project_id'=>$project
				)
		);
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
			if($this->data["Milestone"]["name"] == ''){
				$this->Milestone->save($this->data);
			}else{
				$this->__addMilestones($this->data , $project);
			}
				$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
			 
		}
		$users = $this->Milestone->User->find('list' , array('conditions'=>array('User.redalto'=>1)));
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

	function master_delete($id = null , $project) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Milestone', true), array('action'=>'index'));
		}
		if ($this->Milestone->del($id)) {
			$related = $this->Task->find('all' , array('conditions'=>array('Task.milestone_id'=>$id)));
			foreach($related as $tsk){
				$this->Task->id = $tsk["Task"]["id"];
				$this->Task->saveField('milestone_id' , 0);
			}
			if(isset($project)){
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true ,$project));
			}else{
				$this->redirect(array('controller'=>'milestones' , 'action'=>'index' , 'master'=>true ,$project));
			}			
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
	
	function __addMilestones($data , $project){
		foreach($data["Mile"] as $milestone){
			if($milestone["add"] == 1){
					$rec["Milestone"]["project_id"] = $project;
					$rec["Milestone"]["name"] = $milestone["name"];
					$rec["Milestone"]["startdate"] = $milestone["startdate"];
					$rec["Milestone"]["enddate"] = $milestone["enddate"];
					$rec["Milestone"]["key"] = $milestone["key"];
					$rec["Milestone"]["status"] = $milestone["status"];
					$rec["Milestone"]["color"] = $milestone["color"];
					$rec["Milestone"]["order"] = $milestone["order"];
					$this->Milestone->create();
					$this->Milestone->save($rec);
			}
			
		}
	}

}
?>
