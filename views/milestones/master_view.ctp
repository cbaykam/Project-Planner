<h1><?php echo $tsk->dispProj($milestone);?>
	<?php echo $html->link('Return To Project' , array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $milestone["Project"]["id"]))?>	
</h1>
<div id="pagetitle"><h1><?php echo $milestone['Milestone']['name']; ?></h1></div>
<div id="projectLeftSide">
<div class="milestones view">
	<?php echo $html->link("Add Task" , array('controller'=>'tasks' , 'action'=>'add' ,'master'=>true , $milestone["Milestone"]["project_id"] , 0 , 0 , 0 , 0 , $milestone["Milestone"]["id"]) , array('class'=>'buttonlink')) ?>
	<?php if(count($milestone["Task"]) != 0):?>
		<h3>Tasks For The Milestone</h3>
		<table>
  			<tr>
					<th>Created</th>
					<th>Description</th>
					<th>Priority</th>
					<th>Status</th>
					<th>Due</th>
					<th>Owner</th>
					<th>Completed</th>
					<th>Actions</th>
			</tr>

		<?php foreach($milestone["Task"] as $task):?>
			<tr>
									
									<td><?php echo $timecal->format($task["created"]); ?></td>
									<td><?php echo $html->link($task["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["id"] , $milestone["Project"]["id"]) ); ?></td>
									<td><?php echo $priority->display($task["priority"]); ?></td>
									<td><?php echo $task["status"]; ?> %</td>
									<td><?php echo $timecal->format($task["duedate"]); ?></td>
									<?php if ($task["user_id"] == 0): ?>
									 <td class="tdformdiv">
										-
									 </td>
									<?php else: ?>
										<td><?php echo $task["name"]; ?>
									<?php endif; ?>
									<td><?php echo $tsk->done($task["enddate"]); ?></td>
									<td><?php echo $html->link($html->image('ico_delete.gif') , array('controller' => 'tasks' , 'action' => 'delete','master'=>true , $task["id"] , $milestone["Project"]["id"]) , array() , "Please confirm that you want to permenantly remove this task" , null , false ); ?> <?php echo $html->link($html->image('ico_modify.gif') , array('controller' => 'tasks' , 'action' => 'edit','master'=>true , $task["id"] , $milestone["Project"]["id"]), null , null , false ); ?></td>
								</tr>		
		<?php endforeach;?>
		</table>
	<?php else:?>
		<h3>No Tasks For this Milestone</h3>
	<?php endif;?>
	<?php echo $html->link("Return To Project" , array('controller'=>'projects' , 'action'=>'view' , 'master'=>true ,$milestone['Milestone']['project_id']) , array('class'=>'buttonlink'))?>
</div>