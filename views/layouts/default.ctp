<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Project Planner</title>
<?php echo $javascript->link('jquery-1.3.2.min'); ?>
<?php echo $html->css('default'); ?>
<?php echo $scripts_for_layout; ?>
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="#"><span>Project</span>Planner</a></h1>
	</div>
	<div id="menu">
		<ul id="main">
			<li><?php echo $html->link("Projects" , array('controller' => 'Projects' , 'action' => 'index') ); ?></li>
			<li><a href="#">Tasks</a></li>
			<li><a href="#">Services</a></li>
			<li><a href="#">About Us</a></li>
			<?php if ($authuser): ?>
			   <li><?php echo $html->link("Logout" , array('controller' => 'users' , 'action' => 'logout') ); ?></li> 
		    <?php else: ?>
		       <li><?php echo $html->link("Login" , array('controller' => 'users' , 'action' => 'login') ); ?></li>
		    <?php endif; ?>
		</ul>
	</div>
	
</div>
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">
	<div id="page-bgtop">
	<div id="page-bgbtm">
		
		<!-- start content -->
		<div id="content">
			<div class="flower"></div>
			<?php if ($_SESSION["Message"]["flash"]["message"] != ''): ?>
			    <?php echo $_SESSION["Message"]["flash"]["message"]; ?>
			    <?php  $_SESSION["Message"]["flash"]["message"] = '';?>
			<?php endif; ?>
			<?php echo $content_for_layout; ?>
		</div>
		<!-- end content -->
		<!-- start sidebars -->
		<div id="sidebar2" class="sidebar">		
					<?php echo $this->element('projside'); ?>
		</div>
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	</div>
	</div>
	<!-- end page -->
</div>
</body>
</html>
