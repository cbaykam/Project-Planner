<?php
class Task extends AppModel {

	var $name = 'Task';
	
	var $validate = array(
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Project' => array('className' => 'Project',
								'foreignKey' => 'project_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Milestone'=>array('className' => 'Milestone',
								'foreignKey' => 'milestone_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'Bug'=>array('className' => 'Milestone',
						 'foreignKey' => 'milestone_id',
						 'conditions' => '',
						 'fields' => '',
						 'order' => ''	
			)
	);
	
	var $hasMany = array(
			'Activity'=> array(
						'className' => 'Activity',
						'foreignKey' => 'task_id',
						'dependent' => false,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'exclusive' => '',
						'finderQuery' => '',
						'counterQuery' => ''
			)
	);
	
	function comparedate($date1 , $date2){
		$start = strtotime($date1['startdate']);
		$end = strtotime($date2['duedate']);
		
		if ($start > $end)
		{
			return false;
		}
		else{
			return true;
		}
	}

}
?>
