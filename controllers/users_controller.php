<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form' , 'Usr');
	var $uses = array('User' , 'Project');
	var $logoutUrls = array('/master/users/logout' , '/users/logout');
	
	function beforeFilter(){
		 parent::beforeFilter(); 
		 $this->Auth->allowedActions = array('remindpass' , 'master_remindpass');
	}

	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
	}
	
	function edit($id = null) {
		$this->__belongs(false , null , 'User' , $id);
		$userdat = $this->User->read(null, $id);
		$this->set("userDat" , $userdat);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if($this->data['User']['password'] == ''){
				unset($this->data["User"]["password"]);
			}
			if ($this->User->save($this->data)) {
				//redirection
				if($userdat["User"]["redalto"] == 0){
					$this->redirect(array('controller'=>'projects' , 'action'=>'index'));	
				}else{
					$this->redirect(array('controller'=>'projects' , 'action'=>'index'));
				}
				
			} 
		}
	}

	function view($id = null) {
		$this->set("data" , $this->User->findById($id));
		$this->Project->recursive = 0;
		$this->set("projects" , $this->Project->find("all"));
	}

	function master_index($customer = 0) {
		$this->__checkadmin();
		$this->User->recursive = 1;
		$this->set('iscustomer', $customer);
		if ($customer != 0)
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
		$users = $this->User->find('all' , array('order'=>array('User.name') , 'conditions'=>array('User.redalto'=>'1') ) );
		$this->set("timell" , $this->__generateTimeline($users));
	}
	
	function master_listview(){
		$this->__checkadmin();
		$this->paginate = array('conditions'=>array('User.redalto'=>1) );
		$this->set('users', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		$data = $this->User->findById($id);
		$this->set("data" , $data);
		$this->Project->recursive = 0;
		$this->set("projects" , $this->Project->find("all"));
		if($data["User"]["redalto"] == 0){
			$projet = $this->Project->find('all', array('conditions'=>array('Project.customer'=>$data["User"]["name"])));
			$this->set('custProj' , $projet);
		}
	}

	function master_add($customer = null) {
		$this->__checkadmin();
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				if($customer != null){
					$this->redirect(array('controller'=>'users' , 'action'=>'index','master'=>true , 1));
				}else{
					$this->redirect(array('controller'=>'users' , 'action'=>'listview','master'=>true));
				}
			} 
		}
		$projects = $this->User->Project->find('list');
		$this->set(compact('projects'));
	}
	
	function remind(){
		if(!empty($this->data)){
			
		}
	}


	function master_edit($id = null) {
		$this->__checkadmin();
		$userdat = $this->User->read(null, $id);
		$this->set("userDat" , $userdat);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid User', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if($this->data['User']['password'] == ''){
				unset($this->data["User"]["password"]);
			}
			if ($this->User->save($this->data)) {
				//redirection
				if($userdat["User"]["redalto"] == 0){
					$this->redirect(array('controller'=>'users' , 'action'=>'index', 'master'=>true , 1));	
				}else{
					$this->redirect(array('controller'=>'users' , 'action'=>'listview', 'master'=>true , 0));
				}
				
			} 
		}
	}

	function master_delete($id = null , $customer = 0) {
		$this->__checkadmin();
		if ($this->User->del($id)) {
			if($customer == 0){
				$this->redirect(array('controller'=>'users', 'action'=>'listview','master'=>true));	
			}else{
				$this->redirect(array('controller'=>'users', 'action'=>'index','master'=>true , $customer));
			}
			
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
	
	function remindpass(){
		
		if(!empty($this->data)){
			$user = $this->User->find('all' , array(
						'conditions'=>array(
							'User.email'=>$this->data["User"]["username"]
						),
						'limit'=>1
			));	
			
			if(count($user) != 0){
				$this->__remindmail($user[0]["User"]["email"] , $user[0]["User"]["password"]);
				$this->Session->setFlash('Mail Sent');	
				$this->redirect(array('controller'=>'users' , 'action'=>'login' , 'master'=>true));
			}else{
				$this->Session->setFlash('Could not find an account with the specified e-mail address.');
			}
			
			
		}	
	}
	
	function master_remindpass(){
		
		if(!empty($this->data)){
			$user = $this->User->find('all' , array(
						'conditions'=>array(
							'User.email'=>$this->data["User"]["username"]
						),
						'limit'=>1
			));	
			
			if(count($user) != 0){
				$this->__remindmail($user[0]["User"]["email"] , $user[0]["User"]["password"]);
				$this->Session->setFlash('Mail Sent');	
				$this->redirect(array('controller'=>'users' , 'action'=>'login' , 'master'=>true));
			}else{
				$this->Session->setFlash('Could not find an account with the specified e-mail address.');
			}
			
			
		}
	}
	
	function __remindmail($email , $pass){
		$this->Email->from    = 'Redalto <project@redalto.com>';
		$this->Email->to      = $email;
		$this->Email->subject = 'Your Project Planner Password';
		$message = 'Your project planner password is:' . $pass;
		$this->Email->send($message);
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
