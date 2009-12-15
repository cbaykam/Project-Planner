<?php if ($adminuser): ?>
	<ul id="main">
				<li><?php echo $html->link("Projects" , array('controller' => 'Projects' , 'action' => 'index') ); ?></li>
				<li><?php echo $html->link("Add user" , array('controller' => 'users' , 'action' => 'add', 'master'=>true) ); ?></li>
				<?php if ($authuser): ?>
				   <li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 
				<?php else: ?>
				   <li><?php echo $html->link("Login" , array('controller' => 'users' , 'action' => 'login') ); ?></li>
				<?php endif; ?>
	</ul>
<?php endif; ?>
