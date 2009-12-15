<?php
class User extends AppModel {

	var $name = 'User';
	
	var $validate = array(
			'email'=>'email',
			'name'=> array(
				'between' => array(
		            'rule' => array('between', 5, 45),
		            'message' => 'User\'s Name shall be Between 5 to 45 characters'
            	)
			),
			
			'pwork' => array(
				'integer' => array(
					'rule' => 'numeric',
					'message' => 'Please enter only digits for your phone number.'
				)
			),
			'pmobile' => array(
				'integer' => array(
					'rule' => 'numeric',
					'message' => 'Please enter only digits for your mobile number.'
				)
			)
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
			),
			'Activity' => array('className' => 'Activity',
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
			),
			'Milestone' => array('className' => 'Milestone',
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
	
	  function validateLogin($data)
    {
        $user = $this->find(array('username' => $data['username'], 'password' => md5($data['password'])), array('id', 'username'));
        if(empty($user) == false)
            return $user['User'];
        return false;
    } 

}
?>
