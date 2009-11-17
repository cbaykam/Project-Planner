<?php 
/* SVN FILE: $Id$ */
/* Notice Test cases generated on: 2009-11-16 14:11:45 : 1258375005*/
App::import('Model', 'Notice');

class TestNotice extends Notice {
	var $cacheSources = false;
	var $useDbConfig  = 'test_suite';
}

class NoticeTestCase extends CakeTestCase {
	var $Notice = null;
	var $fixtures = array('app.notice', 'app.project');

	function start() {
		parent::start();
		$this->Notice = new TestNotice();
	}

	function testNoticeInstance() {
		$this->assertTrue(is_a($this->Notice, 'Notice'));
	}

	function testNoticeFind() {
		$this->Notice->recursive = -1;
		$results = $this->Notice->find('first');
		$this->assertTrue(!empty($results));

		$expected = array('Notice' => array(
			'id'  => 1,
			'project_id'  => 1,
			'noticescol'  => 'Lorem ipsum dolor sit amet'
			));
		$this->assertEqual($results, $expected);
	}
}
?>