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
				<td><?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view' , $project["Project"]["id"]) );?></td>
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
				<td><?php echo $html->link("View" , array('controller' => 'projects' , 'action' => 'view', $project["Project"]["id"]) ); ?> </td>
			</tr>

	<?php endforeach;?>

</table>
