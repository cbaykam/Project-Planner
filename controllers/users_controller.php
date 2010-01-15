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


	function master_index($customer = null) {
		$this->__checkadmin();
		$this->User->recursive = 1;
		if ($customer)
		{
			$this->paginate = array('conditions'=>array('User.redalto'=>0) );
			$this->set("timeline" , false);
		}else{
			$this->paginate = array('conditions'=>array('User.redalto'=>1) );
			$this->set("timeline" , true);
		}
		$this->set('users', $this->paginate());
		
		$users = $this->User->find('all' , array('order'=>array('User.name') ) );
		$this->set("timell" , $this->__generateTimeline($users));
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
				$this->redirect(array('controller'=>'users' , 'action'=>'index','master'=>true));
			} else {
			}
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}


	function master_edit($id = null) {
		$this->__checkadmin();
		$this->set("userDat" , $this->User->read(null, $id));
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->User->save($this->data)) {
				$this->redirect(array('controller'=>'users' , 'action'=>'index', 'master'=>true));
			} 
		}
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
		   	if ($this->__checkadmin(null , false))
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
		   
			if ($this->__checkadmin(null , false))
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
	
	function __generateTimeline($data){
		$first = true;
		$timell = '';
		for ($i = 0; $i < count($data) ; $i++)
		{
			
			if (count($data[$i]["Holiday"]) != 0)
			{
				$link = '<a href="/planner/master/users/view/' . $data[$i]["User"]["id"] . '">' . $data[$i]["User"]["name"] . '</a>';
				$timell .= "{'titles': '". $link ."', 
								'events':[";
				foreach ($data[$i]["Holiday"] as $milestone)
				{
					$start = $this->__timelineDate($milestone["start"]) ;
					$end = $this->__timelineDate($milestone["end"]) ;
					 if ($milestone["type"] == 'o')
					 {
					 	$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'color':'#ff7c80'},";	
					 }else{
					 	$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'color':'#fcd5b5'},";
					 }
					  	
					 
							
				}
				
				$timell .= "]},";
							
			}else{
				$link = '<a href="/planner/master/users/view/' . $data[$i]["User"]["id"] . '">' . $data[$i]["User"]["name"] . '</a>';
				
				$timell .= "{'titles': '". $link ."', 
								'events':[
									{'start_date':'19800120', 'end_date':'19800121', 'color':'#ff7c80'}
								]},";
			}
		}
		
		return $timell;
	}

}
?>
