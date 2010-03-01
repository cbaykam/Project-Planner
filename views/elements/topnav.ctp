<?php $loginurls = array('/' , 'master/users/login' , 'master/users/remindpass' , 'users/remindpass' , 'master/users/logoutred' , 'users/logoutred');?>
<?php if ($adminuser): ?>
	<ul id="qm0" class="qmmc">

	<li<?php if($this->params["url"]["url"]=="master/projects"):?> id="activeTab"<?php endif;?>><?php echo $html->link("HOME" , array('controller' => 'projects' , 'action' => 'index' , 'master'=>true) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/users/index/1"):?> id="activeTab"<?php endif;?>><?php echo $html->link("CUSTOMERS" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/projects/timeline" || $this->params["url"]["url"]=="master/projects/listview"):?> id="activeTab"<?php endif;?>><?php echo $html->link("ALL PROJECTS" , array('controller' => 'projects' , 'action' => 'timeline' , 'master'=>true) ); ?>

		<ul>
			<li><?php echo $html->link("Timeline View" , array('controller' => 'projects' , 'action' => 'timeline' , 'master'=>true) ); ?></li>
			<li><?php echo $html->link("List View" , array('controller' => 'projects' , 'action' => 'listview' , 'master'=>true) ); ?></li>
		</ul>
	</li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/tasks/indexjobs/0"):?> id="activeTab"<?php endif;?>><?php echo $html->link("SUPPORT JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 0) ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/tasks/indexjobs/1"):?> id="activeTab"<?php endif;?>><?php echo $html->link("REDALTO JOBS" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 1) ); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/users/listview" || $this->params["url"]["url"]=="master/users/available"):?> id="activeTab"<?php endif;?>><?php echo $html->link("RESOURCES" , array('controller' => 'users' , 'action' => 'listview' , 'master'=>true) ); ?>
		<ul>
			<li><?php echo $html->link("Resource List" , array('controller' => 'users' , 'action' => 'listview' , 'master'=>true) ); ?></li>
			<li><?php echo $html->link("Resource Availability" , array('controller' => 'users' , 'action' => 'available' , 'master'=>true) ); ?></li>
		</ul>
	</li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<?php $linktask = 'master/tasks/viewuser/' . $user_idd?>
	<li<?php if($this->params["url"]["url"]==$linktask):?> id="activeTab"<?php endif;?>><?php echo $html->link('MY TASKS', array('controller'=>'tasks' ,'action'=>'viewuser' ,'master'=>true , $user_idd)); ?></li>
	<?php $linkacc = 'master/users/edit/' . $user_idd?>
	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]== $linkacc):?> id="activeTab"<?php endif;?>><?php echo $html->link('MY ACCOUNT', array('controller'=>'users' ,'action'=>'edit' ,'master'=>true , $user_idd)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li<?php if($this->params["url"]["url"]=="master/projects/admin"):?> id="activeTab"<?php endif;?>><?php echo $html->link('ADMIN', array('controller'=>'projects' ,'action'=>'admin' ,'master'=>true)); ?></li>
	
	<li><span class="qmdivider qmdividery" ></span></li>
	<li><?php echo $html->link('LOGOUT', array('controller'=>'users' ,'action'=>'sessiondestroy')); ?></li>

<li class="qmclear">&nbsp;</li></ul>


<?php elseif(!in_array($this->params["url"]["url"] , $loginurls)):?>
	
	
	<ul id="qm0" class="qmmc">

	<li><?php echo $html->link("HOME" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>

	<li><span class="qmdivider qmdividery" ></span></li>
	
	<li><?php echo $html->link("ALL PROJECTS" , array('controller' => 'projects' , 'action' => 'timeline') ); ?>

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
