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
				<td><?php echo $timecal->format($project["Project"]["duedate"]);?></td>
				<td><?php echo $html->link("Go To" , array('controller' => 'projects' , 'action' => 'view', $project["Project"]["id"]) ); ?></td>
			</tr>

	<?php endforeach;?>

</table>
</div>
