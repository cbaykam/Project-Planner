<?php
class StatussesController extends AppController {

	var $name = 'Statusses';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Statuss->recursive = 0;
		$this->set('statusses', $this->paginate());
	}

	function view($project) {
			$this->set("data" , $this->Statuss->find('all' , 
										array(
										    'conditions'=>array(
										        	'Statuss.project_id'=>$project
										    ),
										    'order'=>'Statuss.id DESC'
										)
						));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Statuss->create();
			if ($this->Statuss->save($this->data)) {
				$this->flash(__('Statuss saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Statuss->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Statuss->save($this->data)) {
				$this->flash(__('The Statuss has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Statuss->read(null, $id);
		}
		$projects = $this->Statuss->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		if ($this->Statuss->del($id)) {
			$this->flash(__('Statuss deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Statuss->recursive = 0;
		$this->paginate = array('order'=>'Statuss.id DESC');
		$this->set('statusses', $this->paginate());
	}

	function master_view($project) {
		$this->__checkadmin();
		$this->set("data" , $this->Statuss->find('all' , 
										array(
										    'conditions'=>array(
										        	'Statuss.project_id'=>$project
										    ),
										    'order'=>'Statuss.id DESC'
										)
						));
		
	}

	function master_add($project) {
		$this->__checkadmin($project);
		if (!empty($this->data)) {
			$this->data["Statuss"]["project_id"] = $project;
			$this->Statuss->create();
			if ($this->Statuss->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
			} else {
			}
		}
		$projects = $this->Statuss->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_edit($id = null , $project) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Statuss->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true, $project));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Statuss->read(null, $id);
		}
		$projects = $this->Statuss->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_delete($id = null , $project) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		if ($this->Statuss->del($id)) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true, $project));
		}
	}

}
?>
