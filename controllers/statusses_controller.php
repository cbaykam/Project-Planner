<?php
class StatussesController extends AppController {

	var $name = 'Statusses';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Statuss->recursive = 0;
		$this->set('statusses', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		$this->set('statuss', $this->Statuss->read(null, $id));
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
		$this->set('statusses', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		$this->set('statuss', $this->Statuss->read(null, $id));
	}

	function master_add() {
		$this->__checkadmin();
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

	function master_edit($id = null) {
		$this->__checkadmin();
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

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Statuss', true), array('action'=>'index'));
		}
		if ($this->Statuss->del($id)) {
			$this->flash(__('Statuss deleted', true), array('action'=>'index'));
		}
	}

}
?>
