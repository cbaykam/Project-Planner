<?php
class Activity extends AppModel {

	var $name = 'Activity';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Task' => array('className' => 'Task',
								'foreignKey' => 'task_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			),
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>
