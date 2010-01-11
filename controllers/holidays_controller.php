<?php
class HolidaysController extends AppController {

	var $name = 'Holidays';
	var $helpers = array('Html', 'Form');

	function index() {
		$this->Holiday->recursive = 0;
		$this->set('holidays', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		$this->set('holiday', $this->Holiday->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Holiday->create();
			if ($this->Holiday->save($this->data)) {
				$this->flash(__('Holiday saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$users = $this->Holiday->User->find('list');
		$this->set(compact('users'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Holiday->save($this->data)) {
				$this->flash(__('The Holiday has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Holiday->read(null, $id);
		}
		$users = $this->Holiday->User->find('list');
		$this->set(compact('users'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		if ($this->Holiday->del($id)) {
			$this->flash(__('Holiday deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->Holiday->recursive = 0;
		$this->set('holidays', $this->paginate());
	}

	function master_view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		$this->set('holiday', $this->Holiday->read(null, $id));
	}

	function master_add() {
		if (!empty($this->data)) {
			$this->Holiday->create();
			if ($this->Holiday->save($this->data)) {
				$this->flash(__('Holiday saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$users = $this->Holiday->User->find('list');
		$this->set(compact('users'));
	}

	function master_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Holiday->save($this->data)) {
				$this->flash(__('The Holiday has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Holiday->read(null, $id);
		}
		$users = $this->Holiday->User->find('list');
		$this->set(compact('users'));
	}

	function master_delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Holiday', true), array('action'=>'index'));
		}
		if ($this->Holiday->del($id)) {
			$this->flash(__('Holiday deleted', true), array('action'=>'index'));
		}
	}
	
	function __createHolidays(){
		
	}

}
?>
