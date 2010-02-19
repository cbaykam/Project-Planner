<div id="projectLeftSide">
<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?><br><br>

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
				<td>
					<?php if ($project["Project"]["redalto"]): ?>
						<?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) );?>
					<?php else: ?>
						<?php 
							$prname = $project["Project"]["customer"] . ':' . $project["Project"]["name"];
						?>
						<?php echo $html->link($prname , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) );?>
					<?php endif; ?>
				</td>
				<td>
					<?php if ($project["Project"]["redalto"]): ?>
					 <?php echo "Redalto"; ?>
					<?php else: ?>
					 <?php echo "Customer"; ?>
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
				<td><?php echo $timecal->format($currMile["enddate"]);?></td>
				<td><?php echo $html->link("Go To" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Rename" , array('controller' => 'projects' , 'action' => 'edit','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive','master'=>true , $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', 'master'=>true, $project["Project"]["id"] ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
			</tr>

	<?php endforeach;?>

</table>
</div>