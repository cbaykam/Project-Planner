<?php
class Project extends AppModel {

	var $name = 'Project';

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $hasMany = array(
			'Milestone' => array('className' => 'Milestone',
								'foreignKey' => 'project_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Notice' => array('className' => 'Notice',
								'foreignKey' => 'project_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Task' => array('className' => 'Task',
								'foreignKey' => 'project_id',
								'dependent' => false,
								'conditions' => '',
								'fields' => '',
								'order' => '',
								'limit' => '',
								'offset' => '',
								'exclusive' => '',
								'finderQuery' => '',
								'counterQuery' => ''
			),
			'Link' => array('className' => 'Link',
								'foreignKey' => 'project_id',
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

	var $hasAndBelongsToMany = array(
			'User' => array('className' => 'User',
						'joinTable' => 'users_projects',
						'foreignKey' => 'project_id',
						'associationForeignKey' => 'user_id',
						'unique' => true,
						'conditions' => '',
						'fields' => '',
						'order' => '',
						'limit' => '',
						'offset' => '',
						'finderQuery' => '',
						'deleteQuery' => '',
						'insertQuery' => ''
			)
	);

}
?>
