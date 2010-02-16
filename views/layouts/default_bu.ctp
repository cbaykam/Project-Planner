<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Project Planner</title>
<script type="text/javascript"> 
    var baseUrl = '<?php echo Configure::read('appPath'); ?>';
</script>
<?php echo $html->css('default'); ?>
<?php echo $scripts_for_layout; ?>
<?php echo $this->element('timeline'); ?>
<?php echo $this->element('colorpicker'); ?>
</head>
<body>
<!-- start header -->
<div id="header">
	<div id="logo">
		<h1><a href="#"><span>Project</span>Planner</a></h1>
	</div>
	<div id="menu">
		<?php echo $this->element('topnav'); ?>
	</div>
	
</div>
<!-- end header -->
<div id="wrapper">
	<!-- start page -->
	<div id="page">

		
		<!-- start content -->
		<div id="content">
			<div class="flower"></div>
			<?php if (isset($_SESSION["Message"]["flash"]["message"]) && $_SESSION["Message"]["flash"]["message"] != ''): ?>
			    <span id="sessionMessage"><?php echo $_SESSION["Message"]["flash"]["message"]; ?></span>
			    <?php  $_SESSION["Message"]["flash"]["message"] = '';?>
			<?php endif; ?>
			<?php echo $content_for_layout; ?>
		</div>
		<!-- end content -->
		<!-- start sidebars -->
		<!-- end sidebars -->
		<div style="clear: both;">&nbsp;</div>
	</div>
	<!-- end page -->
</div>
</body>
</html>
