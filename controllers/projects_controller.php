<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form' , 'Priority', 'Tsk');
	var $uses = array('Project' , 'User' , 'UsersProject' , 'Task' , 'Bug', 'Notice' , 'Milestone');
	
	function index() {
		if($this->Auth->user('admin') == 1){
			$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
		}
		$this->Project->recursive = 2;
		// find the projects user in 
		$userProjs = $this->UsersProject->find('all' , array('conditions'=>array('UsersProject.user_id'=>$this->Auth->user("id"))));
		$pui = array();
		foreach($userProjs as $puai){
			$pui[] = $puai["Project"]["id"];
		}
		$data = $this->Project->find('all' , array(
									'conditions'=>array(
										'Project.id'=>$pui,
										'NOT'=>array(
											'Project.currstats'=>array('complete' , 'arch')
										)
									),
									'order'=>array(
										'Project.redalto DESC',
										'Project.created ASC'
									),
									'limit'=>5
		) );
		
		$topfivetasks = $this->Task->find("all" , array(
												'limit'=>5,
												'conditions'=>array(
													'Task.user_id'=>$this->Auth->user("id"),
													'NOT'=>array(
														'Task.status'=>100
													)
												),
												'order'=>array(
													'Task.enddate ASC'
												)
		));
		
		$this->set("customerbugs" , $this->Task->find('count' , 
										array(
										    'conditions'=>array(
										    	 'Task.type'=>'customer',
										    	 'Task.enddate'=>'0000-00-00',
										    	 'Task.user_id'=>$this->Auth->User('id')
										    )
										)
						));	
		$this->set("redaltobugs" , $this->Task->find('count' , 
										array(
										    'conditions'=>array(
										    	 'Task.type'=>'redalto',
												 'Task.enddate'=>'0000-00-00',
												 'Task.user_id'=>$this->Auth->User('id')
										    )
										)
						));	
						
		//get the projects in of the users to get the notices. 
		$projuserar = $this->UsersProject->find('all' , array('conditions'=>array('UsersProject.user_id'=>$this->Auth->user('id'))));
		$projectsusersin = array(0=>'0');
		for ($i = 0; $i < count($projuserar); $i++) {
			$projectsusersin[] = $projuserar[$i]['UsersProject']['project_id'];	
		}
		$pui[] = 0;
		$this->set('notices' , $this->Notice->find('all' , array(
												'conditions'=>array(
													'Notice.project_id'=>$pui
												),
												'limit'=>4
		)));
				
		$this->set('projects', $data);
		$this->set("username" , $this->Auth->user('name'));
		$this->set("timeline" , true);
		$this->set("duotime" , true);
		$this->set("toptasks" , $topfivetasks);
		$this->set("timell" , $this->__generateTimeline($data , false));
	}
	
	function timeline(){
		$redalto = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>1,
											  'Project.id'=>$this->__fetchProjects()
										    )
										)
						);
		$consumer = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>0,
											  'Project.id'=>$this->__fetchProjects()
										    )
										)
						);	
		$this->set("timeline" , true);
		$this->set("duotime" , true);
		$this->set("timell" , $this->__generateTimeline($redalto , false));
		$this->set("ganttconsumer" , $this->__generateTimeline($consumer , false));
	}
	
	function listview(){
		$dat =  $this->Project->find('all' , array('conditions'=>array('Project.id'=>$this->__fetchProjects())));
		$miles = array();
		for($i = 0 ; $i < count($dat) ; $i++){
			$miles[$dat[$i]['Project']['id']] = $this->Milestone->find('all' , array('conditions'=>array('Milestone.project_id'=>$dat[$i]['Project']['id']) , 'order'=>'Milestone.enddate ASC'));
		}
		$this->set('miles' , $miles);
		$this->set('projects' , $dat);
	}

	function view($id) {
		$this->__belongs(true , $id);
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$prdat = $this->Project->read(null, $id);
		if($prdat["Project"]["user_id"] == $this->Auth->user("id")){
			$this->redirect(array('controller'=>'projects' , 'action'=>'view' , 'master'=>true ,$id ));
		}
		$this->set('project', $prdat);
        $this->set("users" , $this->User->find('list' , array('conditions'=>array('redalto'=>'1'))));
        // Why fetching seperately 
        $this->Task->recursive = 1;
        $this->set("tasks" , $this->Task->find('all' , array(
        										'conditions'=>array(
        											'Task.project_id'=>$id,
        											'Task.type'=>null
        										)
        ) ));
        // Fetch users in the project 
		$usersa = array();
		$i = 0;
		foreach ($prdat["User"] as $res)
		{
			if($res["redalto"] == 1){
				$usersa[$i]['name'] = $res["name"];
				$usersa[$i]['id'] = $res["id"];
				$i++;
			}
			
		}
		$this->set("sumhours" , $this->__calcDuration($prdat));
		$this->set(compact('usersa'));
		$milestones = $this->Milestone->find('all' , array('conditions'=>array("Milestone.project_id"=>$id) ,'order'=>'Milestone.enddate'));
		$this->set("mlstns" , $milestones);
	}

	function allprojects(){
		$redalto = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>1
										    )
										)
						);
		$consumer = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>0
										    )
										)
						);
		$this->set("timeline" , true);
		$this->set("duotime" , true);	
		$this->set("timell" , $this->__generateTimeline($redalto));
		$this->set("ganttconsumer" , $this->__generateTimeline($consumer));
	}
	
	function master_allprojects(){
		$this->__checkadmin();
		$redalto = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>1
										    )
										)
						);
		$consumer = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>0
										    )
										)
						);	
		$this->set('projects' , $this->Project->find('all'));
		$this->set("timeline" , true);
		$this->set("duotime" , true);
		$this->set("timell" , $this->__generateTimeline($redalto));
		$this->set("ganttconsumer" , $this->__generateTimeline($consumer));
	}
	
	function master_timeline(){
		$this->__checkadmin();
		$redalto = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>1
										    )
										)
						);
		$consumer = $this->Project->find('all' , 
										array(
										    'conditions'=>array(
										      'Project.redalto'=>0
										    )
										)
						);	
		$this->set("timeline" , true);
		$this->set("duotime" , true);
		$this->set("timell" , $this->__generateTimeline($redalto));
		$this->set("ganttconsumer" , $this->__generateTimeline($consumer));
	}
	
	function master_listview(){
		$this->__checkadmin();
		$dat =  $this->Project->find('all', array('order'=>array('Project.redalto')));
		$miles = array();
		for($i = 0 ; $i < count($dat) ; $i++){
			$miles[$dat[$i]['Project']['id']] = $this->Milestone->find('all' , array('conditions'=>array('Milestone.project_id'=>$dat[$i]['Project']['id']) , 'order'=>'Milestone.enddate ASC'));
		}
		$this->set('projects' , $dat);
		$this->set('miles' , $miles);
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
										'Project.redalto DESC',
										'Project.created ASC'
									),
									'limit'=>5
		) );
		
		$topfivetasks = $this->Task->find("all" , array(
												'limit'=>5,
												'conditions'=>array(
													'Task.user_id'=>$this->Auth->user("id"),
													'NOT'=>array(
														'Task.status'=>100
													)
												),
												'order'=>array(
													'Task.enddate ASC'
												)
		));
		
		$this->set("customerbugs" , $this->Task->find('count' , 
										array(
										    'conditions'=>array(
										    	 'Task.type'=>'customer',
										    	 'Task.enddate'=>'0000-00-00'
										    )
										)
						));	
		$this->set("redaltobugs" , $this->Task->find('count' , 
										array(
										    'conditions'=>array(
										    	 'Task.type'=>'redalto',
												 'Task.enddate'=>'0000-00-00'
										    )
										)
						));	
						
		//get the projects in of the users to get the notices. 
		$projuserar = $this->UsersProject->find('all' , array('conditions'=>array('UsersProject.user_id'=>$this->Auth->user('id'))));
		$projectsusersin = array(0=>'0');
		for ($i = 0; $i < count($projuserar); $i++) {
			$projectsusersin[] = $projuserar[$i]['UsersProject']['project_id'];	
		}
		$this->set('notices' , $this->Notice->find('all' , array(
												'conditions'=>array(
													'Notice.project_id'=>$projectsusersin
												),
												'limit'=>4
		)));
				
		$this->set('projects', $data);
		$this->set("username" , $this->Auth->user('name'));
		$this->set("timeline" , true);
		$this->set("duotime" , true);
		$this->set("toptasks" , $topfivetasks);
		$this->set("timell" , $this->__generateTimeline($data));
	}

	function master_view($id = null) {
		$this->__checkadmin($id);
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$prdat = $this->Project->read(null, $id);
		$this->set('project', $prdat);
        $this->set("users" , $this->User->find('list' , array('conditions'=>array('User.redalto'=>'1' ))));
        // Why fetching seperately 
        $this->Task->recursive = 1;
        $this->set("tasks" , $this->Task->find('all' , array(
        										'conditions'=>array(
        											'Task.project_id'=>$id,
        											'Task.type'=>null
        										)
        ) ));
        // Fetch users in the project 
		$usersa = array();
		$i = 0;
		foreach ($prdat["User"] as $res)
		{
			if($res["redalto"] == 1){
				$usersa[$i]['name'] = $res["name"];
				$usersa[$i]['id'] = $res["id"];
				$i++;
			}
			
		}
		$milestones = $this->Milestone->find('all' , array('conditions'=>array("Milestone.project_id"=>$id) ,'order'=>'Milestone.enddate'));
		$this->set("mlstns" , $milestones);
		$this->set("sumhours" , $this->__calcDuration($prdat));
		$this->set(compact('usersa'));
		
	}
	
	function master_reports(){
		$this->__checkadmin();
		$data = $this->Project->find('all');
		for ($i = 0; $i < count($data) ; $i++)
		{
			$data[$i]['duration'] = $this->__calcDuration($data[$i]);			
		}
		$this->set("data" , $data);
	}

	function master_add() {
		$this->__checkadmin();
		$this->set("colorpicker" , true);
		if (!empty($this->data)) {
			$this->data["Project"]["budget"] = $this->__calculatetime($this->data["Project"]["hours"] , $this->data["Project"]["mins"]);
			// Add the project admin to the project
				
		
			$this->Project->create();
			if ($this->Project->save($this->data)) {
				$this->__addMilestones($this->data , $this->Project->getLastInsertID());
				$this->Session->setFlash("Your Project Succesfully Saved");
				$updat = array();
				$updat["UsersProject"]["user_id"] = $this->data["Project"]["user_id"];
				$updat["UsersProject"]["project_id"] = $this->Project->getLastInsertID() ;
				$this->UsersProject->create();
				$this->UsersProject->save($updat);
				$this->redirect(array('controller'=>'projects' , 'action'=>'index' , 'master'=>true));
			} 
		}
		$users = $this->Project->User->find('list' , array('conditions'=>array('User.redalto'=>'1') ) );
		$cust = $this->User->find('all' , array('conditions'=>array('User.redalto'=>0)));
		$this->set(compact('users'));
		$this->set('customerdata' , $cust);
	}

	function master_edit($id = null , $where = 'main') {
		$this->__checkadmin($id);
		if (!$id && empty($this->data)) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		if (!empty($this->data)) {
			$this->Project->id = $id;
			if ($this->Project->save($this->data)) {
				if($where == 'main'){
					$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true));
				}
				else if($where == 'list'){
					$this->redirect(array('controller'=>'projects' , 'action'=>'listview','master'=>true));
				}
			} else {
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Project->read(null, $id);
			$bb = $this->data["Project"]["budget"] / 60;
			$this->set('budget' , $bb);
			$cust = $this->User->find('all' , array('conditions'=>array('User.redalto'=>0) , 'order'=>'User.name'));
			$this->set('customerdata' , $cust);
		}
		$users = $this->Project->User->find('list' , array('conditions'=>array('User.redalto'=>'1') ) );
		$this->set(compact('users'));
	}
	/*
	 * Changes the overview of the project.
	 */
	function master_changeover($project){
		$this->__checkadmin($project);	
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

	function master_delete($id = null , $where = 'main') {
		$this->__checkadmin($id);
		if (!$id) {
		}
		if ($this->Project->del($id)) {
			if($where == 'main'){
				$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true));
			}
			else if($where == 'list'){
				$this->redirect(array('controller'=>'projects' , 'action'=>'listview','master'=>true));
			}
		}
	}
	
	function master_archive($project){
		$this->__checkadmin($project);
		$this->Project->id = $project;
		$this->Project->saveField('currstats' , 'arch');
		$this->redirect(array('controller'=>'projects' , 'action'=>'index','master'=>true ));
	}
	
	function master_admin(){
		$this->__checkadmin();
	}

	function __generateTimeline($data , $master = true){
		$first = true;
		$timell = '';
		for ($i = 0; $i < count($data) ; $i++)
		{
			
			if (count($data[$i]["Milestone"]) != 0)
			{
				if(!$first){
					$timell .= ",";
					
				}
				$first = false;	
				if($master){
					if($data[$i]["Project"]["redalto"] == 1){
						$link = '<a href="'. Configure::read('appPath') . 'master/projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["name"] . '</a>';
					}else{
						$link = '<a href="'. Configure::read('appPath') . 'master/projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["customer"] . ':' . $data[$i]["Project"]["name"] . '</a>';
					}
					
				}else{
					if($data[$i]["Project"]["redalto"] == 1){
						$link = '<a href="'. Configure::read('appPath') . 'projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["name"] . '</a>';
					}else{
						$link = '<a href="'. Configure::read('appPath') . 'projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["customer"] . ':'  . $data[$i]["Project"]["name"] . '</a>';
					}
				}
				
				$timell .= "{'titles': '". $link ."', 
								'events':[";
				
				//foreach ($data[$i]["Milestone"] as $milestone)
				
				for($j = 0 ; $j < count($data[$i]["Milestone"]) ; $j++)
				{
					
					$tudo = count($data[$i]["Milestone"]) - 1;
					$start = $this->__timelineDate($data[$i]["Milestone"][$j]["startdate"]) ;
					$end = $this->__timelineDate($data[$i]["Milestone"][$j]["enddate"]) ;
					 if ($this->__overdue($end) && $data[$i]["Milestone"][$j]["completed"] == '0000-00-00' )
					 {
					 	
					 	if($j == $tudo){
					 		$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(!)</b>', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'}";
					 	}else{
					 		$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(!)</b>', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'},";
					 	}
					  	
					 }else{
					 	if ($data[$i]["Milestone"][$j]["completed"] == '0000-00-00')
					 	{
					 		if($j == $tudo){
					 			$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'}";
					 		}else{
					 			$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'},";
					 		}
					 		
					 	}else{
					 		if($j == $tudo){
					 			$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(OK)</b>', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'}";
					 		}else{
					 			$timell .= "{'start_date':'".$start."', 'end_date':'".$end."', 'text':'<b>(OK)</b>', 'color':'" . $data[$i]["Milestone"][$j]['color'] . "'},";
					 		}
					 		
					 	}
					 	
					 }
							
				}
				
					$timell .= "]}";
				
				
							
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
	
	function __addMilestones($data , $project){
		foreach($data["Milestone"] as $milestone){
			if($milestone["add"] == 1){
					$rec["Milestone"]["project_id"] = $project;
					$rec["Milestone"]["name"] = $milestone["name"];
					$rec["Milestone"]["startdate"] = $milestone["startdate"];
					$rec["Milestone"]["enddate"] = $milestone["enddate"];
					$rec["Milestone"]["key"] = $milestone["key"];
					$rec["Milestone"]["status"] = $milestone["status"];
					$rec["Milestone"]["color"] = $milestone["color"];
					$rec["Milestone"]["order"] = $milestone["order"];
					$this->Milestone->create();
					$this->Milestone->save($rec);
			}
			
		}
	}
	
	
	

}
?>
