<div id="pagetitle"><h1>Completed Tasks</h1></div>
<div id="projectLeftSide">
<?php if(count($data) != 0):?>
	<h3></h3>
		<table style="width:95%;">
			<tr>
				<th>Created</th>
				<th>Description</th>
				<th>Project Phase</th>
				<th>Priority</th>
				<th>Status</th>
				<th>Due</th>
				<th>Hours</th>
				<th>Owner</th>
				<th width="70">Actions</th>
			</tr>
			<?php foreach($data as $task):?>
			
			<tr>
				<td><?php echo $timecal->format($task["Task"]["created"]); ?></td>
				<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["Task"]["id"] , $project) ); ?></td>
				<td><?php echo $task["Milestone"]["name"]; ?></td>
				<td><?php echo $priority->display($task["Task"]["priority"]); ?></td>
				<td><?php echo $task["Task"]["status"]; ?> %</td>
				<td><?php echo $timecal->format($task["Task"]["duedate"]); ?></td>
				<td><?php echo $tsk->duration($task["Activity"]); ?></td>
					<?php if ($task["Task"]["user_id"] == 0): ?>
						 <td class="tdformdiv">
							-
						 </td>
				<?php else: ?>
							<td><?php echo $task["User"]["name"]; ?>
									<?php endif; ?>
									<td><?php echo $html->link($html->image('ico_delete.gif') , array('controller' => 'tasks' , 'action' => 'delete','master'=>true , $task["Task"]["id"] , $project) , array() , "Please confirm that you want to permenantly remove this task" , null , false ); ?> <?php echo $html->link($html->image('ico_modify.gif') , array('controller' => 'tasks' , 'action' => 'edit','master'=>true , $task["Task"]["id"] , $project), null , null , false ); ?></td>
								</tr>		
							<?php endforeach;?>
							
							</table>

<?php else:?>
	None of the tasks are completed
<?php endif;?>
<?php echo $html->link('Return To Project' ,array('controller'=>'projects' , 'action'=>'view' , 'master'=>true , $project) , array('class'=>'buttonlink'))?>
</div>