<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<div id="projectLeftSide">
	<h1> Welcome : <?php echo $username; ?> </h1>
	
	<h3> Top 5 Projects This Week </h3>

	<a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 
	<br><br>
	
	
	<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?>
	<?php echo $html->link("Standard Milestones" , array('controller'=>'standarts' , 'action'=>'index' , 'master'=>true ) , array('class'=>'buttonlink'))?>
	
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
					<td><?php echo $html->link($task["Project"]["name"] , array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $task["Project"]["id"]));?></td>
					<td><?php echo $task["Milestone"]["name"];?></td>
					<td><?php echo $html->link($task["Task"]["name"] , array('controller'=>'tasks' , 'action'=>'view' , 'master'=>true , $task["Task"]["id"]));?></td>
					<td><?php echo $priority->display($task["Task"]["priority"]);?></td>
					<td><?php echo $timecal->format($task["Task"]["duedate"]);?></td>
					<td><?php echo $task["Task"]["status"];?> %</td>
				</tr>
			<?php endforeach;?>
			<tr>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th></th>
				<th><?php echo $html->link('View All' , array('controller'=>'tasks' , 'action'=>'viewuser' , 'master'=>true , $toptasks[0]["Task"]["user_id"]));?></th>
			</tr>
		</table>
	<?php else:?>
		<h3>No Tasks assigned for you.</h3>
	<?php endif;?>
</div>
<div id="projectRightSide">
<?php echo $html->link("View Reports" , array('controller' => 'projects' , 'action' => 'reports','master'=>true), array('class'=>'buttonlink2') ); ?>
<table border="0" cellspacing="0" cellpadding="0" style="width:70%;">
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
			<?php echo $html->link( "View Details" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,'master'=>true ) ); ?>
		</td>
	</tr>
	
	
</table>
<br>

<table border="0" cellspacing="0" cellpadding="0" style="width:70%;">
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
			<?php echo $html->link( "View Details" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,'master'=>true , 1 ) ); ?>
		</td>
	</tr>
	
	
</table>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th></th><th>Notice Board</th>
	</tr>
		
				<?php foreach ($notices as $notice):?>
					<tr>
						<td><?php echo $timecal->format($notice["Notice"]["date"]);?></td>
						<td><?php echo $notice["Notice"]["title"];?></td>
					</tr>
					<tr>
						<td></td>
						<td><?php echo $notice["Notice"]["noticescol"];?></td>
					</tr>
				<?php endforeach;?>
		<tr>
			<td></td>
			<th><?php echo $html->link('View All' , array('controller'=>'notices' , 'action'=>'index' , 'master'=>true));?></th>
		</tr>
	</table>
	<?php echo $html->link('Add Notice' , array('controller'=>'notices' , 'action'=>'add' , 'master'=>true) , array('class'=>'buttonlink2'))?>
</div>

