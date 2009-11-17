<?php
class BugsController extends AppController {

	var $name = 'Bugs';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		$this->set('bug', $this->Bug->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bug->create();
			if ($this->Bug->save($this->data)) {
				$this->flash(__('Bug saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Bug->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bug->save($this->data)) {
				$this->flash(__('The Bug has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bug->read(null, $id);
		}
		$projects = $this->Bug->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		if ($this->Bug->del($id)) {
			$this->flash(__('Bug deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());
	}

	function master_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		$this->set('bug', $this->Bug->read(null, $id));
	}

	function master_add() {
		if (!empty($this->data)) {
			$this->Bug->create();
			if ($this->Bug->save($this->data)) {
				$this->flash(__('Bug saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->Bug->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bug->save($this->data)) {
				$this->flash(__('The Bug has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bug->read(null, $id);
		}
		$projects = $this->Bug->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		if ($this->Bug->del($id)) {
			$this->flash(__('Bug deleted', true), array('action'=>'index'));
		}
	}

}
?>