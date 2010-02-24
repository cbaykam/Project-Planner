<div id="pagetitle"><h1>Admin </h1></div>
<div id="projectLeftSide">
	<?php echo $html->link("View Reports" , array('controller' => 'projects' , 'action' => 'reports','master'=>true), array('class'=>'buttonlink') ); ?>
	<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?>
	<?php echo $html->link("Standard Milestones" , array('controller'=>'standarts' , 'action'=>'index' , 'master'=>true ) , array('class'=>'buttonlink'))?>
	<?php echo $html->link("Notices" , array('controller'=>'notices' , 'action'=>'index' , 'master'=>true ) , array('class'=>'buttonlink''))?>
</div>