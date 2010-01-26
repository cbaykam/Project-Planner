<?php $loginurls = array('/' , 'master/users/login');?>
<?php if ($adminuser): ?>
	<ul id="qm0" class="qmmc">

	<li><?php echo $html->link("HOME" , array('controller' => 'projects' , 'action' => 'index' , 'master'=>true) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("CUSTOMERS" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="javascript:void(0)">ALL PROJECTS</a>

		<ul>
			<li><?php echo $html->link("Timeline View" , array('controller' => 'projects' , 'action' => 'timeline' , 'master'=>true) ); ?></li>
			<li><?php echo $html->link("List View" , array('controller' => 'projects' , 'action' => 'listview' , 'master'=>true) ); ?></li>
		</ul>
	</li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("SUPPORT JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 0) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("REDALTO JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 1) ); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="javascript:void(0);">RESOURCES</a>
		<ul>
			<li><?php echo $html->link("Resource List" , array('controller' => 'users' , 'action' => 'listview' , 'master'=>true) ); ?></li>
			<li><?php echo $html->link("Resource Availability" , array('controller' => 'users' , 'action' => 'available' , 'master'=>true) ); ?></li>
		</ul>
	</li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('MY TASKS', array('controller'=>'tasks' ,'action'=>'viewuser' ,'master'=>true , $user_idd)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('MY ACCOUNT', array('controller'=>'users' ,'action'=>'edit' ,'master'=>true , $user_idd)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('LOGOUT', array('controller'=>'users' ,'action'=>'sessiondestroy')); ?></li>

<li class="qmclear">&nbsp;</li></ul>


<?php elseif(!in_array($this->params["url"]["url"] , $loginurls)):?>
	
	
	<ul id="qm0" class="qmmc">

	<li><?php echo $html->link("HOME" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("CUSTOMERS" , array('controller' => 'users' , 'action' => 'index' , 1) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><a class="qmparent" href="javascript:void(0)">ALL PROJECTS</a>

		<ul>
			<li><?php echo $html->link("Timeline View" , array('controller' => 'projects' , 'action' => 'timeline') ); ?></li>
			<li><?php echo $html->link("List View" , array('controller' => 'projects' , 'action' => 'listview') ); ?></li>
		</ul>
	</li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("SUPPORT JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,0) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link("REDALTO JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,1) ); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('MY TASKS', array('controller'=>'tasks' ,'action'=>'viewuser' , $user_idd)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('MY ACCOUNT', array('controller'=>'users' ,'action'=>'edit' , $user_idd)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('LOGOUT', array('controller'=>'users' ,'action'=>'sessiondestroy')); ?></li>

	<li class="qmclear">&nbsp;</li></ul>
	
	
<?php endif; ?>
