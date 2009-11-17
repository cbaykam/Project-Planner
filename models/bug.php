<?php
class Bug extends AppModel {

	var $name = 'Bug';
	var $validate = array(
		'projects_id' => array('numeric'),
		'status' => array('alphanumeric')
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed
	var $belongsTo = array(
			'Projects' => array('className' => 'Projects',
								'foreignKey' => 'projects_id',
								'conditions' => '',
								'fields' => '',
								'order' => ''
			)
	);

}
?>