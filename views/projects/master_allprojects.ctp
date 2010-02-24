<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>



<table style="width:250px;">
  <tr>
    <td></td>
    <th>Standard Project Milestones</th>
  </tr>
  <tr>
    <td>Phase 1</td>
    <td style="background:#d7e4bd;">Consult (Assess & Specify)</td>
  </tr>
  <tr>
    <td>Phase 2</td>
    <td style="background:#fcd5b5;">Design (Graphic Design)</td>
  </tr>
  <tr>
    <td>Phase 3</td>
    <td style="background:#b9cde5;">Build (Web Development)</td>
  </tr>
  <tr>
    <td>Phase 4</td>
    <td style="background:#ffff99;">Test (ORT)</td>
  </tr>
  <tr>
    <td>Phase 5</td>
    <td style="background:#ff99ff;">Launch (UAT & Client Handover)</td>
  </tr>
</table>
<br><br>
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
				<td><?php echo $html->link($project["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) );?></td>
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
				<td><?php echo $html->link("View" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'edit','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive','master'=>true , $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', 'master'=>true, $project["Project"]["id"] ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
			</tr>

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
