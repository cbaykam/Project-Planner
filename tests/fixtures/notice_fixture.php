<?php 
/* SVN FILE: $Id$ */
/* Notice Fixture generated on: 2009-11-16 14:11:45 : 1258375005*/

class NoticeFixture extends CakeTestFixture {
	var $name = 'Notice';
	var $table = 'notices';
	var $fields = array(
			'id' => array('type'=>'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
			'project_id' => array('type'=>'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
			'noticescol' => array('type'=>'string', 'null' => true, 'default' => NULL, 'length' => 45),
			'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_notices_projects1' => array('column' => 'project_id', 'unique' => 0))
			);
	var $records = array(array(
			'id'  => 1,
			'project_id'  => 1,
			'noticescol'  => 'Lorem ipsum dolor sit amet'
			));
}
?>