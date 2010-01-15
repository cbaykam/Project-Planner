<?php if ($adminuser): ?>
	<ul>
				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("Customers" , array('controller' => 'users' , 'action' => 'index' , 'master'=>true , 1) ); ?></li>
				<li><?php echo $html->link("Home" , array('controller' => 'projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("My Account" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
				<li><?php echo $html->link("Resources" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 
				
	</ul>
<?php endif; ?>
