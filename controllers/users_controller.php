<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');
	var $uses = array('User' , 'Project');
	var $logoutUrls = array('/master/users/logout' , '/users/logout');
	
	function beforeFilter(){
		 parent::beforeFilter(); 
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
	
	function master_available(){
		$this->__checkadmin();
		$this->paginate = array('conditions'=>array('User.redalto'=>1) );
		$this->set("timeline" , true);
		$users = $this->User->find('all' , array('order'=>array('User.name') ) );
		$this->set("timell" , $this->__generateTimeline($users));
	}
	
	function master_listview(){
		$this->__checkadmin();
		$this->paginate = array('conditions'=>array('User.redalto'=>1) );
		$this->set('users', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		$this->set("data" , $this->User->findById($id));
		$this->Project->recursive = 0;
		$this->set("projects" , $this->Project->find("all"));
	}

	function master_add($customer = null) {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				if($customer != null){
					$this->redirect(array('controller'=>'users' , 'action'=>'index','master'=>true , 1));
				}else{
					$this->redirect(array('controller'=>'users' , 'action'=>'index','master'=>true));
				}
				$this->redirect(array('controller'=>'users' , 'action'=>'index','master'=>true));
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
		if( in_array($this->Session->read('Auth.redirect') , $this->logoutUrls) ){
			$this->Session->write('Auth.redirect' , '/');
		}
		if ($this->Auth->isAuthorized())
		{ 
		   	if ($this->__checkadmin(null , false))
			{ 
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			}else{
			    $this->redirect(array('controller'=>'projects' , 'action'=>'index'));
			}
		}
	}
	
	function logout(){
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	
	function sessiondestroy(){
		$this->Session->destroy();
		$this->redirect(array('controller'=>'users' , 'action'=>'logout'));
	}
	
	function master_sessiondestroy(){
		$this->Session->destroy();
		$this->redirect(array('controller'=>'users' , 'action'=>'logout'));
	}
	
	function master_login()
	{
		if( in_array($this->Session->read('Auth.redirect') , $this->logoutUrls) ){
			$this->Session->write('Auth.redirect' , '/');
		}
		if ($this->Auth->isAuthorized())
		{ 
		   	if ($this->__checkadmin(null , false))
			{
				 
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			}else{
				$this->redirect(array('controller'=>'projects' , 'action'=>'index'));
			}
		}
	}
	
	function master_logout()
	{
		$this->Session->destroy();
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
