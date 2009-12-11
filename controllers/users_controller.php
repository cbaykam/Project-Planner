<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $uses = array('User' , 'Project');
	
	function beforeFilter(){
		 parent::beforeFilter(); 
		 $this->Auth->allow('add');
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		$this->set('User', $this->User->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->flash(__('User saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->flash(__('The User has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->flash(__('User deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->User->recursive = 0;
		$this->set('Users', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		$this->set("data" , $this->User->findById($id));
		$this->Project->recursive = 0;
		$this->set("projects" , $this->Project->find("all"));
	}

	function master_add() {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				$this->flash(__('User saved.', true), array('controller'=>'projects', 'action'=>'index'));
			} else {
			}
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_edit($id = null) {
		$this->__checkadmin();
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->flash(__('The User has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->User->read(null, $id);
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}

	function master_delete($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if ($this->User->del($id)) {
			$this->flash(__('User deleted', true), array('action'=>'index'));
		}
	}
	
	function login(){
		if ($this->Auth->isAuthorized())
		{ 
		   	if ($this->__checkadmin(false))
			{
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			}else{
				$this->redirect(array('controller'=>'users' , 'action'=>'view' , $this->Auth->user("id")));
			}
		}
	}
	
	function logout(){
		$this->redirect($this->Auth->logout());
	}
	
	function master_login()
	{
		if ($this->Auth->isAuthorized())
		{
			 $this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
		}
		if (!empty($this->data))
		{
		   
			if ($this->__checkadmin(false))
			{
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			}
			if ($this->Auth->isAuthorized())
			{
				$this->redirect(array('controller'=>'users' , 'action'=>'view', $this->Auth->user("id")));
			}
		}
	}
	
	function master_logout()
	{
		$this->redirect($this->Auth->logout());
	}

}
?>
