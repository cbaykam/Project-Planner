<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<div id="projectLeftSide">
	<h1> Welcome : <?php echo $username; ?> </h1>
	<?php echo $html->link("Bugs and Issues" , array('controller' => 'bugs' , 'action' => 'index','master'=>true) );?>
	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<th>Project Name</th>
			<th>Type</th>
			<th>Project Phase</th>
			<th>Due Date</th>
			<th>Action</th>
		</tr>
	
	

	<?php foreach($projects as $project):?>

			<tr>
				<td><?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) );?></td>
				<td>
					<?php if ($project["Project"]["redalto"]): ?>
					 <?php echo "Redalto"; ?>
					<?php else: ?>
					 <?php echo "Consumer"; ?>
					<?php endif; ?>
				</td>
				<td>
					<?php	
						$currMile = $project["Milestone"][0];
						foreach ($project["Milestone"] as $mile)
						{
							if ($currMile["status"] == "Done")
							{
								$currMile = $mile;
							}
							if(strtotime($currMile["enddate"]) > strtotime($mile["enddate"])){
								$currMile = $mile;
							}
						}
						echo $currMile["name"];
					?>	
				</td>
				<td><?php echo $currMile["enddate"];?></td>
				<td><?php echo $html->link("View" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'edit','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive','master'=>true , $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', 'master'=>true, $project["Project"]["id"] ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
			</tr>

	<?php endforeach;?>

	</table>

	<?php echo $html->link("Bugs And Issues" , array('controller' => 'bugs' , 'action' => 'index', 'master'=>true) , array('class'=>'buttonlink') ); ?>

	<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?><br><br>

	<h3> Redalto Projects </h3>

	<a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 
	<br><br><br>
	<h3> Consumer Projects </h3>

	<a href="#" class="GNT_prev3">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev4">[&lt;]</a> 
	<a href="#" class="GNT_now3">now</a> 
	<a href="#" class="GNT_next4">[&gt;]</a> 
	<a href="#" class="GNT_next3">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt2"></div> 
</div>
<div id="projectRightSide">
<?php echo $html->link("View Reports" , array('controller' => 'projects' , 'action' => 'reports','master'=>true), array('class'=>'buttonlink') ); ?>
<table border="0" cellspacing="0" cellpadding="0" style="width:200px;">
	<tr><th>Customer Maintenance & Support Issues</th></tr>
	<tr>
		<td>
			<?php if ($customerbugs == 0): ?>
				ok
			<?php elseif ($customerbugs >= 1 && $customerbugs <= 3  ): ?>
				<div id="attentionrequ">Attention Required <?php echo $customerbugs; ?> open issues</div>
			<?php elseif ($customerbugs >= 4): ?>
				<div id="criticalu"><b>Critical</b> <?php echo $customerbugs; ?> open issues</div>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $html->link( "View Details" , array('controller' => 'bugs' , 'action' => 'index' , null) ); ?>
		</td>
	</tr>
	
	
</table>
<br>

<table border="0" cellspacing="0" cellpadding="0" style="width:200px;">
	<tr><th>Redalto Apps Issue Tracking</th></tr>
	<tr>
		<td>
			<?php if ($redaltobugs == 0): ?>
				<div id="allok">ok</div>
			<?php elseif ($redaltobugs >= 1 && $redaltobugs <= 3  ): ?>
				<div id="attentionrequ">Attention Required <?php echo $redaltobugs; ?> open issues</div>
			<?php elseif ($redaltobugs >= 4): ?>
				<div id="criticalu"><b>Critical</b> <?php echo $redaltobugs; ?> open issues</div>
			<?php endif; ?>
		</td>
	</tr>
	<tr>
		<td>
			<?php echo $html->link( "View Details" , array('controller' => 'bugs' , 'action' => 'index' , 1) ); ?>
		</td>
	</tr>
	
	
</table>

</div>
