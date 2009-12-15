<?php
class LinksController extends AppController {

	var $name = 'Links';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Link->recursive = 0;
		$this->set('links', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		$this->set('link', $this->Link->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Link->create();
			if ($this->Link->save($this->data)) {
				$this->flash(__('Link saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Link->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Link->save($this->data)) {
				$this->flash(__('The Link has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Link->read(null, $id);
		}
		$projects = $this->Link->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		if ($this->Link->del($id)) {
			$this->flash(__('Link deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->Link->recursive = 0;
		$this->set('links', $this->paginate());
	}

	function master_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		$this->set('link', $this->Link->read(null, $id));
	}

	function master_add($project) {
		$this->__checkadmin($project);
		if (!empty($this->data)) {
		    $this->data["Link"]["project_id"] = $project;
			$this->Link->create();
			if ($this->Link->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) );
			} else {
			}
		}
		$projects = $this->Link->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_edit($id = null , $project) {
		$this->__checkadmin($project);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Link->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Link->read(null, $id);
		}
		$projects = $this->Link->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_delete($id = null , $project) {
		$this->__checkadmin($project);
		if (!$id) {
			$this->flash(__('Invalid Link', true), array('action'=>'index'));
		}
		if ($this->Link->del($id)) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
		}
	}

}
?>
