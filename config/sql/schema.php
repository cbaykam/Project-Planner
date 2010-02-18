<?php 
/* SVN FILE: $Id$ */
/* App schema generated on: 2010-02-10 15:02:52 : 1265806852*/
class AppSchema extends CakeSchema {
	var $name = 'App';

	function before($event = array()) {
		return true;
	}

	function after($event = array()) {
	}

	var $activities = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'task_id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 11),
		'date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'project_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'duration' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2048),
		'created' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $holidays = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'description' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'start' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'end' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 2),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $links = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'link' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $milestones = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'index'),
		'status' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'enddate' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'completed' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'order' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'startdate' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'color' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_milestones_projects1' => array('column' => 'project_id', 'unique' => 0))
	);
	var $notices = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'project_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'title' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'noticescol' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'created' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'date' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_notices_projects1' => array('column' => 'project_id', 'unique' => 0))
	);
	var $projects = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'currstats' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 10),
		'overview' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'budget' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'customer_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $standarts = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'color' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 20),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $statusses = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'project_id' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'status' => array('type' => 'text', 'null' => false, 'default' => NULL),
		'created' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $tasks = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 11, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'project_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'creator' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 128),
		'status' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'priority' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'type' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 45),
		'description' => array('type' => 'text', 'null' => true, 'default' => NULL),
		'startdate' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'enddate' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'duedate' => array('type' => 'date', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'milestone_id' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'dependency' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11),
		'created' => array('type' => 'date', 'null' => false, 'default' => NULL),
		'customer' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 500),
		'time' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'recduration' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rechowmany' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'rectimesrun' => array('type' => 'integer', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_tasks_projects1' => array('column' => 'project_id', 'unique' => 0), 'fk_tasks_resources1' => array('column' => 'user_id', 'unique' => 0))
	);
	var $users = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'email' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'password' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'pwork' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'pmobile' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 20),
		'messenger' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'website' => array('type' => 'string', 'null' => false, 'default' => NULL, 'length' => 1024),
		'skype' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 128),
		'admin' => array('type' => 'integer', 'null' => false, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);
	var $users_projects = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'project_id' => array('type' => 'integer', 'null' => true, 'default' => NULL, 'key' => 'index'),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1), 'fk_resources_has_projects_resources' => array('column' => 'user_id', 'unique' => 0), 'fk_resources_has_projects_projects1' => array('column' => 'project_id', 'unique' => 0))
	);
}
?>