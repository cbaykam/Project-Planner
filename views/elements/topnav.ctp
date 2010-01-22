<?php $loginurls = array('/' , 'master/users/login');?>
<?php if ($adminuser): ?>
	<ul>
				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("Customers" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
				<li><?php echo $html->link("All Projects" , array('controller' => 'projects' , 'action' => 'allprojects' , 'master'=>true) ); ?></li>
				<li><?php echo $html->link("Support Jobs" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true ) ); ?></li>
				<li><?php echo $html->link("Redalto Jobs" , array('controller' => 'tasks' , 'action' => 'indexjobs' , 'master'=>true , 1) ); ?></li>
				<li><?php echo $html->link("Resources" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
				<li><?php echo $html->link("My Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser','master'=>true , $user_idd) ); ?></li>
				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 	
	</ul>
<?php elseif(!in_array($this->params["url"]["url"] , $loginurls)):?>
	<ul>
				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("Customers" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 	
	</ul>
<?php endif; ?>
