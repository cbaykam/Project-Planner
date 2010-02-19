<?php
class UsersProjectsController extends AppController {

	var $name = 'UsersProjects';
	var $helpers = array('Html', 'Form');
	var $uses = array('UsersProject' , 'User');


	function add() {
		if (!empty($this->data)) {
			$this->UsersProject->create();
			if ($this->UsersProject->save($this->data)) {
				$this->flash(__('UsersProject saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$users = $this->UsersProject->User->find('list');
		$projects = $this->UsersProject->Project->find('list');
		$this->set(compact('users', 'projects'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid UsersProject', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->UsersProject->save($this->data)) {
				$this->flash(__('The UsersProject has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->UsersProject->read(null, $id);
		}
		$users = $this->UsersProject->User->find('list');
		$projects = $this->UsersProject->Project->find('list');
		$this->set(compact('users','projects'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid UsersProject', true), array('action'=>'index'));
		}
		if ($this->UsersProject->del($id)) {
			$this->flash(__('UsersProject deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->UsersProject->recursive = 0;
		$this->set('usersProjects', $this->paginate());
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid UsersProject', true), array('action'=>'index'));
		}
		$this->set('usersProject', $this->UsersProject->read(null, $id));
	}

	function master_add($project) {
		$this->__checkadmin($project);
		
		if (!empty($this->data)) {
			$udat = $this->User->findById($this->data["UsersProject"]['user_id']);
			$this->data["UsersProject"]["project_id"] = $project;
			$exists = $this->UsersProject->find('all' , array(
										'conditions'=>array(
											'UsersProject.user_id' => $this->data["UsersProject"]['user_id'],
											'UsersProject.project_id' => $project
										)
			) );
			
			if (count($exists) == 0)
			{
					$this->UsersProject->create();
					if ($this->UsersProject->save($this->data)) {
						$this->__eProjectNotification($udat['User']['email']);
						$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));			
					} 
			}else{
				$this->Session->setFlash("User Already Exists in the Project");
				$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
			}
				
		}
	}
	
	function master_toproject($user)
	{
		$this->__checkadmin();
		
		if (!empty($this->data)) {
			$this->data["UsersProject"]["user_id"] = $user;
			
			$exists = $this->UsersProject->find('all' , array(
										'conditions'=>array(
											'UsersProject.user_id' => $user,
											'UsersProject.project_id' => $this->data["UsersProject"]['project_id']
										)
			) );
			
			if (count($exists) == 0)
			{
					$this->UsersProject->create();
					if ($this->UsersProject->save($this->data)) {
					
						$this->redirect(array('controller'=>'users' , 'action'=>'view' , 'master'=>true , $user));
					
						
					} 
			}else{
				$this->Session->setFlash("User Already Exists in the Project");
				$this->redirect(array('controller'=>'users' , 'action'=>'view' , 'master'=>true , $user));
			}
				
		}
	}
	
	function master_delete( $project ,$id ) {
		$dat = $this->UsersProject->find('all' , array('conditions'=>array('UsersProject.user_id' => $id, 'UsersProject.project_id'=>$project)));
		if ($this->UsersProject->del($dat[0]["UsersProject"]["id"])) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project));
		}
	}
	
	
	function __eProjectNotification($email){
		$this->Email->from    = 'Redalto <project@redalto.com>';
		$this->Email->to      = $email;
		$this->Email->subject = 'You Have been Assigned To A Project';
		$message = 'You Are now working on another project please view.';
		$this->Email->send($message);
	}
}
?>
