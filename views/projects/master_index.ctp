<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<h1> Welcome : <?php echo $username; ?> </h1>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th>Project Name</th>
		<th>Type</th>
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
			<td><?php echo $html->link("View" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'edit','master'=>true , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Archive" , array('controller' => 'projects' , 'action' => 'archive','master'=>true , $project["Project"]["id"]), array() , 'Please confirm that you want to Archive the Project' ); ?> | <?php echo $html->link("Delete" , array('controller' => 'projects' , 'action' => 'delete', 'master'=>true, $project["Project"]["id"] ) , array(), "You are about to delete a Project which will permanently remove it from the database. You may choose to alternatively “archive” the project instead. Are you sure you want to permanently remove this project? " ); ?></td>
		</tr>

<?php endforeach;?>



</table>

<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?><br><br>

<a href="#" class="GNT_prev">[&lt;&lt;]</a> 
<a href="#" class="GNT_prev2">[&lt;]</a> 
<a href="#" class="GNT_now">now</a> 
<a href="#" class="GNT_next2">[&gt;]</a> 
<a href="#" class="GNT_next">[&gt;&gt;]</a> 
<br><br>

<div class="gantt" id="gantt"></div> 
