<?php
class Bug extends AppModel {

	var $name = 'Bug';
	var $validate = array(

	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'User' => array('className' => 'User',
								'foreignKey' => 'user_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);
	
	var $hasMany = array(
			'Task'=> array(
						'className' => 'Task',
						'foreignKey' => 'bug_id',
						'dependent' => true,
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
	

}
?>
