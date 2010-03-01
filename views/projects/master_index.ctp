<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<div id="pagetitle"><h1> Welcome : <?php echo $username; ?> </h1></div>	
<div id="projectLeftSide">

	
	<h3> Top 5 Projects This Week </h3>
	<div align="center" class="forwardback">
	<a href="#" class="GNT_prev"><?php echo $html->image("fbackward.gif")?></a> 
	<a href="#" class="GNT_prev2"><?php echo $html->image("backward.gif")?></a> 
	<a href="#" class="GNT_now"><span id="nowsq">Now</b></span> 
	<a href="#" class="GNT_next2"><?php echo $html->image("forward.gif")?></a> 
	<a href="#" class="GNT_next"><?php echo $html->image("fforward.gif")?></a> 
	</div>

	<div class="gantt" id="gantt"></div> 
		<table style="width:95%;">
		  <tr>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td></td>
		    <td width="88" align="center"><?php echo $html->link('View All' , array('controller'=>'projects' , 'action'=>'listview' , 'master'=>true) , array('class'=>'careful')) ?></td>
		  </tr>
		</table>
	
		<h3>My Top 5 Tasks</h3>
	<?php if(count($toptasks) != 0):?>
		<table style="width:95%;">
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
					<td><?php echo $html->link($task["Task"]["name"] , array('controller'=>'tasks' , 'action'=>'view' , 'master'=>true , $task["Task"]["id"] , $task["Project"]["id"]));?></td>
					<td><?php echo $priority->display($task["Task"]["priority"]);?></td>
					<td><?php echo $timecal->format($task["Task"]["duedate"]);?></td>
					<td><?php echo $task["Task"]["status"];?> %</td>
				</tr>
			<?php endforeach;?>
			<tr>
				<td></td><td></td><td></td><td></td><td></td>
				<td width="88" class="careful"><?php echo $html->link('View All' , array('controller'=>'tasks' , 'action'=>'viewuser' , 'master'=>true , $toptasks[0]["Task"]["user_id"]));?></td>
			</tr>
		</table>
		<?php echo $html->link("Add Task" , array('controller'=>'tasks' , 'action'=>'add' , 'master'=>true , 0 , $user_idd , true) , array('class'=>'buttonlink'))?>
	<?php else:?>
		<h3>No Tasks assigned for you.</h3>
	<?php endif;?>
</div>
<div id="projectRightSide2">
<table border="0" style="width:100%;" cellpadding="0" cellspacing="0">
	<tr>
		<th></th><th class="rightsideheader">Notice Board</th>
	</tr>
		
				<?php foreach ($notices as $notice):?>
					<tr>
						<td><?php echo $timecal->format($notice["Notice"]["date"]);?></td>
						<td><b><?php echo $notice["Notice"]["title"];?></b></td>
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
	<br><br>
<table style="width:100%;" cellpadding="0" cellspacing="0">
	<tr><th class="rightsideheader">Customer Maintenance & Support Issues</th></tr>
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
		<td class="actiontd">
			<?php echo $html->link( "View Details" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,'master'=>true ) ); ?>
		</td>
	</tr>
	
	
</table>
<br>

<table style="width:100%;" cellpadding="0" cellspacing="0">
	<tr><th class="rightsideheader">Redalto Apps Issue Tracking</th></tr>
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
		<td class="actiontd">
			<?php echo $html->link( "View Details" , array('controller' => 'tasks' , 'action' => 'indexjobs' ,'master'=>true , 1 ) ); ?>
		</td>
	</tr>
	
	
</table>

</div>

