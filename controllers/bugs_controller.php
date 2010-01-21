<?php
class BugsController extends AppController {

	var $name = 'Bugs';
	var $helpers = array('Html', 'Form' , 'Priority');
	var $uses = array('Bug', 'Project');

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


	function master_index($redalto = null) {
		$this->__checkadmin();
		$this->Bug->recursive = 0;
		if ($redalto)
		{
			$this->paginate = array('conditions'=>array('Bug.redalto'=>'1') );
		}else{
			$this->paginate = array('conditions'=>array('Bug.redalto'=>'0') );
		}
		$this->set('bugs', $this->paginate());
		$this->set("userid" , $this->Auth->user("id"));
	}
	
	function master_filter(){
		$this->__checkadmin();
		$redalto = $this->params['named']['redalto'] ;
		if (isset($this->params["named"]["user"]))
		{
		     $this->paginate = array(
		                  'conditions'=>array(
		                           'Bug.user_id'=>$this->params["named"]["user"] ,
		                           'Bug.redalto'=>$redalto               
		                   )    
		     );
		}else if(isset($this->params["named"]["priority"])){
			$this->paginate = array(
		                  'conditions'=>array(
		                           'Bug.priority'=>$this->params["named"]["priority"],
		                           'Bug.redalto'=>$redalto                  
		                   )    
		     );
		}else if(isset($this->params["named"]["project"])){
			$this->paginate = array(
		                  'conditions'=>array(
		                           'Bug.project_id'=>$this->params["named"]["project"],
		                           'Bug.redalto'=>$redalto                  
		                   )    
		     );
		}
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());
		$this->set("userid" , $this->Auth->user("id"));
	}

	function master_view($id = null) {
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		$this->set('bug', $this->Bug->read(null, $id));
	}

	function master_add() {
		$this->__checkadmin();
		
			$prdat = $this->Project->read(null , $project);	
		
		
		if (!empty($this->data)) {
			
			
			if ($prdat["Project"]["redalto"] == 1)
			{
				$this->data["Bug"]["redalto"] = '1' ;
			}
			$this->Bug->create();
			if ($this->Bug->save($this->data)) {				
				$this->redirect(array('controller'=>'bugs' , 'action'=>'index','master'=>true));
			} 
		}
		
		$users = array();
		foreach ($prdat["User"] as $res)
		{
			$users[$res["id"]] = $res["name"];
		}
		
		$this->set(compact('users'));
		
		
	}
	
	function master_complete($bug){
		$data["Bug"]['status'] = "OK";
		$data["Bug"]["datedone"] = date('Y-m-d');
		$this->Bug->id = $bug;
		$this->Bug->save($data);
		$this->redirect(array('controller'=>'bugs' , 'action'=>'index' ,'master'=>true));
		
	}

	function master_edit($id = null) {
		$this->__checkadmin();
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
		$this->__checkadmin();
		if (!$id) {
			$this->flash(__('Invalid Bug', true), array('action'=>'index'));
		}
		if ($this->Bug->del($id)) {
			$this->flash(__('Bug deleted', true), array('action'=>'index'));
		}
	}

}
?>
