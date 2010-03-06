<div id="projectLeftSide">
<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?><br><br>

<table>
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
						$currMile = $miles[$project["Project"]["id"]][0];
						$cntt = count($miles[$project["Project"]["id"]]);
						foreach ($miles[$project["Project"]["id"]] as $mile)
						{
							if ($currMile["Milestone"]["status"] == "Done")
							{
								$currMile = $mile;
							}
							if(strtotime($currMile["Milestone"]["enddate"]) > strtotime($mile["Milestone"]["enddate"])){
								$currMile = $mile;
							}
							if($currMile["Milestone"]["id"] == $miles[$project["Project"]["id"]][$cntt]["Milestone"]["id"] && $currMile["Milestone"]["status"] == "Done"){
								$currMile["Milestone"]["name"] == "All Completed";
							}
						}
						echo $currMile["Milestone"]["name"];
					?>	
				</td>
				<td><?php echo $timecal->format($project["Project"]["duedate"]);?></td>
				<td><?php echo $html->link("Go To" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'edit','master'=>true , $project["Project"]["id"] , 'list') ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive','master'=>true , $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', 'master'=>true, $project["Project"]["id"] , 'list' ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
			</tr>

	<?php endforeach;?>

</table>
</div>
