<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<div id="projectLeftSide">
	<h1> Welcome : <?php echo $username; ?> </h1>

	<table border="0" cellspacing="0" cellpadding="0">
		<tr>
			<th>Project Name</th>
			<th>Type</th>
			<th>Project Phase</th>
			<th>Due Date</th>
			<th>Action</th>
		</tr>
	
	
	<?php $curr = 0 ;?>
	<?php foreach($projects as $project):?>
		<?php if ($project["Project"]["id"] != $curr):?>
			<tr>
				<td><?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view', $project["Project"]["id"]) );?></td>
				<td>
					<?php if ($project["Project"]["redalto"]): ?>
					 <?php echo "Redalto"; ?>
					<?php else: ?>
					 <?php echo "Customer"; ?>
					<?php endif; ?>
				</td>
				<td>
				 
					<?php	
						$currMile = $project["Project"]["Milestone"][0];
						foreach ($project["Project"]["Milestone"] as $mile)
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
				<td><?php echo $html->link("View" , array('controller' => 'projects' , 'action' => 'view' , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'edit', $project["Project"]["id"]) ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive', $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', $project["Project"]["id"] ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
			</tr>
			<?php $curr = $project["Project"]["id"];?>
			<?php endif;?>
	<?php endforeach;?>

	</table>
	
	<h3> Redalto Projects </h3>

	<a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 
	<br><br><br>
	<h3> Customer Projects </h3>

	<a href="#" class="GNT_prev3">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev4">[&lt;]</a> 
	<a href="#" class="GNT_now3">now</a> 
	<a href="#" class="GNT_next4">[&gt;]</a> 
	<a href="#" class="GNT_next3">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt2"></div> 
	
	<br><br>
		<h3>My Top 5 Tasks</h3>
	<?php if(count($toptasks) != 0):?>
		<table border="0" cellspacing="0" cellpadding="0">
			<tr>
				<th>Project</th>
				<th>Phase</th>
				<th>Description</th>
				<th>Priority</th>
				<th>Due</th>
				<th>Status</th>
			</tr>
			<?php foreach($toptasks as $task):?>
				<tr>
					<td><?php echo $html->link($task["Project"]["name"] , array('controller'=>'projects' , 'action'=>'view' , $task["Project"]["id"]));?></td>
					<td><?php echo $task["Milestone"]["name"];?></td>
					<td><?php echo $html->link($task["Task"]["name"] , array('controller'=>'tasks' , 'action'=>'view' , $task["Task"]["id"]));?></td>
					<td><?php echo $priority->display($task["Task"]["priority"]);?></td>
					<td><?php echo $task["Task"]["duedate"];?></td>
					<td><?php echo $task["Task"]["status"];?> %</td>
				</tr>
			<?php endforeach;?>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th><?php echo $html->link('View All' , array('controller'=>'tasks' , 'action'=>'viewuser' , $toptasks[0]["Task"]["user_id"]));?></th>
			</tr>
		</table>
	<?php else:?>
		<h3>No Tasks assigned for you.</h3>
	<?php endif;?>
</div>
<div id="projectRightSide">
<table border="0" cellspacing="0" cellpadding="0" style="width:200px;">
	<tr><th>Customer Maintenance & Support Issues</th></tr>
	<tr>
		<td>
			<?php if ($customerbugs == 0): ?>
				<div id="allok">ok</div>
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

<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th></th><th>Notice Board</th>
	</tr>
		<?php foreach ($prj["Project"]["Notice"] as $notice):?>
			<tr>
				<td><?php echo $notice["created"];?></td>
				<td><?php echo $notice["title"];?></td>
			</tr>
			<tr>
				<td></td>
				<td><?php echo $notice["noticescol"];?></td>
			</tr>
		<?php endforeach;?>
	</table>
</div>