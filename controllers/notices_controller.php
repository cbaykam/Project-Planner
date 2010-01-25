<?php
class NoticesController extends AppController {

	var $name = 'Notices';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Notice->recursive = 0;
		$this->set('notices', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Notice', true), array('action'=>'index'));
		}
		$this->set('notice', $this->Notice->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Notice->create();
			if ($this->Notice->save($this->data)) {
				$this->flash(__('Notice saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Notice->Project->find('list');
		$this->set(compact('projects'));
	}



	function master_index() {
		$this->__checkadmin();
		$this->Notice->recursive = 0;
		$this->set('notices', $this->paginate());
	}

	function master_view($project=null) {
		$this->__checkadmin();
		
			$this->set("data" , $this->Notice->find('all' , array(
								'conditions'=>array(
									'OR'=>array(
										'Notice.project_id'=>array('0' , $project)
									)		
								),
								'order'=>array(
									'Notice.project_id DESC'  
								)
			)));
		
	}

	function master_add($project = 0) {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->data["Notice"]["project_id"] = $project;
			$this->Notice->create();
			if ($this->Notice->save($this->data)) {
				if($project == 0){
					$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true));
				}else{
					$this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true, $project));
				}
				
			} 
		}
		$projects = $this->Notice->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_edit($id = null) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Notice', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Notice->save($this->data)) {
				$this->flash(__('The Notice has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Notice->read(null, $id);
		}
		$projects = $this->Notice->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Notice', true), array('action'=>'index'));
		}
		if ($this->Notice->del($id)) {
			$this->redirect(array('controller'=>'notices' , 'action'=>'index' , 'master'=>true));
		}
	}

}
?>
