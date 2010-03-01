<?php
class StandartsController extends AppController {

	var $name = 'Standarts';
	var $helpers = array('Html', 'Form' , 'Color');

	function master_index() {
		$this->__checkadmin();
		$this->Standart->recursive = 0;
		$this->set('standarts', $this->paginate());
	}

	function master_add() {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->Standart->create();
			if ($this->Standart->save($this->data)) {
				$this->redirect(array('controller'=>'standarts' , 'action'=>'index' , 'master'=>true ));
			} 
		}
	}

	function master_edit($id = null) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Standart', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Standart->save($this->data)) {
				$this->redirect(array('controller'=>'standarts' , 'action'=>'index' , 'master'=>true ));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Standart->read(null, $id);
		}
	}

	function master_delete($id = null) {
		$this->__checkadmin();		
		if (!$id) {
			$this->flash(__('Invalid Standart', true), array('action'=>'index'));
		}
		if ($this->Standart->del($id)) {
			$this->redirect(array('controller'=>'standarts' , 'action'=>'index' , 'master'=>true));
		}
	}

}
?>