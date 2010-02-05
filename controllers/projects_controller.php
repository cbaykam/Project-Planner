<?php
class ProjectsController extends AppController {

	var $name = 'Projects';
	var $helpers = array('Html', 'Form' , 'Priority', 'Tsk');
	var $uses = array('Project' , 'User' , 'UsersProject' , 'Task' , 'Bug', 'Notice');
	
	function index() {
		
		$this->UsersProject->recursive = 2;
		// pagination variable 
		$this->paginate = array(
					'UsersProject'=>array(
							'conditions'=>array(
								'UsersProject.user_id'=>$this->Auth->user("id"),
								'NOT'=>array(
									'Project.currstats'=>array('complete' , 'arch')
								)
							 ),
							 'order'=>array(
							 	'Project.redalto DESC',
							 	'Project.created ASC'
							 ),
							 'limit'=>5
								
					)
		);
		/*
		 * Getting all the project ids for the users .
		 * For seperating the redalto and consumer jobs. 
		 */
		$prdat = $this->UsersProject->find('all' , array(
									'conditions'=>array(
										'UsersProject.user_id'=>$this->Auth->user("id"),
										'NOT'=>array(
											'Project.currstats'=>array('complete' , 'arch')
										 )
									 ),
							 		'order'=>array(
							 			'Project.redalto DESC',
							 			'Project.created ASC'
							 		),
							 		'limit'=>5
		));
		// the id of all the projects 
		$prids = array();
		
		for ($i = 0 ; $i < count($prdat) ; $i++){
			array_push($prids, $prdat[$i]["Project"]["id"]);
		}
		
		//consumer projetcts for the timeline .
		$consumer = $this->Project->find("all" , array(
									'conditions'=>array(
											'Project.id'=>$prids,
											'Project.redalto'=>0
									)								
		));
		
		//redalto projects for the timeline 
		$redalto = $this->Project->find("all" , array(
									'conditions'=>array(
											'Project.id'=>$prids,
											'Project.redalto'=>1
									)								
		));
		//top 5 tasks
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
		
		//get the notices 
		$this->set('notices' ,$this->Notice->find('all' , array('limit'=>5)));
		//set the duo variable and the timeline because there will be 2 timelines
		$this->set("timeline" , true);
		$this->set("toptasks" , $topfivetasks);
		$this->set("timell" , $this->__generateTimeline($redalto));
		$this->set("ganttconsumer" , $this->__generateTimeline($consumer));
		$this->set('projects', $this->paginate('UsersProject'));
		$this->set("username" , $this->Auth->user('name'));
	}
	
	function timeline(){
		
	}
	
	function listview(){
		
	}

	function view($id = null) {
		if (!$id) {
			$this->flash(__('Invalid Project', true), array('action'=>'index'));
		}
		$this->set('project', $this->Project->read(null, $id));
        $this->set("users" , $this->User->find('all'));
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
		$this->set('projects' , $this->Project->find('all'));
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
        $this->set("users" , $this->User->find('list'));
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
			$usersa[$i]['name'] = $res["name"];
			$usersa[$i]['id'] = $res["id"];
			$i++;
		}
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
			if ($this->Project->saveAll($this->data)) {
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
		$customers = $this->Project->User->find('list' , array('conditions'=>array('User.redalto'=>'0') , 'order'=>array('User.name') ) );
		$this->set(compact('users' , 'customers'));
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
				$link = '<a href="'. Configure::read('appPath') . 'master/projects/view/' . $data[$i]["Project"]["id"] . '">' . $data[$i]["Project"]["name"] . '</a>';
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
