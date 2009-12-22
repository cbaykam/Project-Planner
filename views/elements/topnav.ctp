<?php if ($adminuser): ?>
	<ul>
				<li><?php echo $html->link("Projects" , array('controller' => 'Projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("Add user" , array('controller' => 'users' , 'action' => 'add', 'master'=>true) ); ?></li>
				<li><?php echo $html->link("Edit User Details" , array('controller' => 'users' , 'action' => 'edit','master'=>true , $user_idd) ); ?></li>
				<li><?php echo $html->link("View All Users" , array('controller' => 'users' , 'action' => 'index','master'=>true) ); ?></li>
				<li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 
				
	</ul>
<?php endif; ?>
