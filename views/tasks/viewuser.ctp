<div id="pagetitle"><h1>My Tasks</h1></div>
<div id="projectLeftSide">
<?php if(isset($tasks[0]["User"]["name"])):?>
<table style="width:300px;">
	<tr><th></th><th></th></tr>
	<tr>
		<td>Name</td>
		<td><?php echo $tasks[0]["User"]["name"]; ?></td>
	</tr>
	<tr>
		<td>Resource Id</td>
		<td><?php echo $tasks[0]["User"]["id"]; ?></td>
	</tr>	
</table>

<table>
	<tr>
		<th>Task List</th><th></th><th></th><th></th><th></th><th></th><th></th>
	</tr>
	<tr>
		<th>Created</th>
		<th>Description</th>
		<th>Project</th>
		<th>Due</th>
		<th>Status</th>
		<th>Hours</th>
		<th>Date Done</th>
	</tr>
<?php foreach($tasks as $task):?>
		<tr>
			<td><?php echo $task["Task"]["created"]; ?></td>
			<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view', $task["Task"]["id"] , $task["Project"]["id"]) );  ?></td>		
			<td><?php echo $html->link($task["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view', $task["Project"]["id"]) ); ?></td>
			<td><?php echo $task["Task"]["duedate"]; ?></td>
			<td><?php echo $task["Task"]["status"]; ?> %</td>
			<td><?php echo $tsk->duration($task["Activity"]); ?></td>
			<td><?php echo $tsk->done($task["Task"]["enddate"]); ?></td>
		</tr>
<?php endforeach;?>
</table>
<?php else:?>
	<h2>No Tasks for the User</h2>
<?php endif;?>
</div>
