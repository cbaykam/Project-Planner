<?php
class User extends AppModel {

	var $name = 'User';
	
	var $validate = array(
			
	);

	var $hasMany = array(
			'Task' => array('className' => 'Task',
								'foreignKey' => 'user_id',
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
			'Project' => array('className' => 'Project',
						'joinTable' => 'users_projects',
						'foreignKey' => 'user_id',
						'associationForeignKey' => 'project_id',
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
