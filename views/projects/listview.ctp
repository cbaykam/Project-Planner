<div id="projectLeftSide">

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
						<?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view' , $project["Project"]["id"]) );?>
					<?php else: ?>
						<?php 
							$prname = $project["Project"]["customer"] . ':' . $project["Project"]["name"];
						?>
						<?php echo $html->link($prname , array('controller' => 'projects' , 'action' => 'view',$project["Project"]["id"]) );?>
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
				<td><?php echo $html->link("Go To" , array('controller' => 'projects' , 'action' => 'view', $project["Project"]["id"]) ); ?></td>
			</tr>

	<?php endforeach;?>

</table>
</div>
