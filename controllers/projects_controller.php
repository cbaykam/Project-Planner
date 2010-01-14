<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form' , 'Priority', 'Tsk');
	var $uses = array('Project' , 'User' , 'UsersProject' , 'Task');
	
	function index() {
		$this->Project->recursive = 0;
		$this->set('projects', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
        $this->set("users" , $this->User->find('all'));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->flash(__('Project saved.', true), array('action'=>'index'));
			} else {
			}
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->flash(__('The Project has been saved.', true), array('action'=>'index'));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
		$resources = $this->Project->User->find('list');
		$this->set(compact('resources'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if ($this->Project->del($id)) {
			$this->flash(__('Project deleted', true), array('action'=>'index'));
		}
	}


	function master_index() {
		$this->__checkadmin();
		$this->Project->recursive = 2;
		$data = $this->Project->find('all' , array(
									'conditions'=>array(
										'NOT'=>array(
											'Project.currstats'=>array('complete' , 'arch')
										)
									),
									'order'=>array(
										'Project.redalto DESC'
									)
		) );
		$this->set('projects', $data);
		$this->set("username" , $this->Auth->user('name'));
		$this->set("timeline" , true);
		$this->set("timell" , $this->__generateTimeline($data));
	}

	function master_view($id = null) {
		$this->__checkadmin($id);
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$prdat = $this->Project->read(null, $id);
		$this->set('project', $prdat);
        $this->set("users" , $this->User->find('list'));
        // Why fetching seperately 
        $this->Task->recursive = 1;
        $this->set("tasks" , $this->Task->find('all' , array(
        										'conditions'=>array(
        											'Task.project_id'=>$id
        										)
        ) ));
        // Fetch users in the project 
		$usersa = array();
		$i = 0;
		foreach ($prdat["User"] as $res)
		{
			$usersa[$i]['name'] = $res["name"];
			$usersa[$i]['id'] = $res["id"];
			$i++;
		}
		$this->set("sumhours" , $this->__calcDuration($prdat));
		$this->set(compact('usersa'));
		
	}

	function master_add() {
		$this->__checkadmin();
		$this->set("colorpicker" , true);
		if (!empty($this->data)) {
			$this->data["Project"]["budget"] = $this->__calculatetime($this->data["Project"]["hours"] , $this->data["Project"]["mins"]);
			$this->Project->create();
			if ($this->Project->saveAll($this->data)) {
				$this->Session->setFlash("Your Project Succesfully Saved");
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			} 
		}
		$users = $this->Project->User->find('list' , array('conditions'=>array('User.admin'=>'0') ) );
		$this->set(compact('users'));
	}

	function master_edit($id = null) {
		$this->__checkadmin($id);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			if ($this->Project->save($this->data)) {
				$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true));
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
		}
	}
	
	function master_changeover($project){	
	    if (!empty($this->data))
	    {
	    	 $this->Project->id = $project;
	    	 $this->Project->saveField('overview' , $this->data["Project"]["overview"]);
	    	 $this->redirect(array('controller'=>'projects' , 'action'=>'view','master'=>true , $project));
	    }else{
			$this->data = $this->Project->read(null, $project);
			$this->set("proj" , $this->data);
		}
	}

	function master_delete($id = null) {
		$this->__checkadmin($id);
		if (!$id) {
		}
		if ($this->Project->del($id)) {
			$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true));
		}
	}
	
	function master_archive($project){
		$this->__checkadmin($project);
		$this->Project->id = $project;
		$this->Project->saveField('currstats' , 'arch');
		$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true ));
	}
	
	function __addMilestones($project){
		$milestone['Milestone']['project_id'] = $project;
		$milestone['Milestone']['name'] = 'Consult (Assess & Specify)';
	}
	
	function __generateTimeline($data){
		$first = true;
		$timell = '';
		for ($i = 0; $i < count($data) ; $i++)
		{
			
			if (count($data[$i]["Milestone"]) != 0)
			{
				$link = '<a href="/planner/master/projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["name"] . '</a>';
				$timell .= "{'titles': '". $link ."', 
								'events':[";
				foreach ($data[$i]["Milestone"] as $milestone)
				{
					$start = $this->__timelineDate($milestone["startdate"]) ;
					$end = $this->__timelineDate($milestone["enddate"]) ;;
					 if ($this->__overdue($end) && $milestone["completed"] == '0000-00-00' )
					 {
					  	$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(!)</b>', 'color':'" . $milestone['color'] . "'},";
					 }else{
					 	if ($milestone["completed"] == '0000-00-00')
					 	{
					 		$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'color':'" . $milestone['color'] . "'},";
					 	}else{
					 		$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(OK)</b>', 'color':'" . $milestone['color'] . "'},";
					 	}
					 	
					 }
							
				}
				
				$timell .= "]},";
							
			}
		}
		
		return $timell;
	}
	// Calculate the total hours worked for the project
	function __calcDuration($project){
		$sum = 0;
		foreach ($project["Activity"] as $activity)
		{
			$sum = $sum + $activity['duration'];
		}
		return $sum;
	}
	
	

}
?>
