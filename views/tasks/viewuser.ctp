<table border="0" cellspacing="0" cellpadding="0" style="width:300px;">
	<tr><th>Resource</th><th></th></tr>
	<tr>
		<td>Name</td>
		<td><?php echo $tasks[0]["User"]["name"]; ?></td>
	</tr>
	<tr>
		<td>Resource Id</td>
		<td><?php echo $tasks[0]["User"]["id"]; ?></td>
	</tr>	
</table>

<table border="0" cellspacing="0" cellpadding="0">
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
			<td><?php echo $html->link($task["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view' , $task["Project"]["id"]) ); ?></td>
			<td><?php echo $task["Task"]["duedate"]; ?></td>
			<td><?php echo $task["Task"]["status"]; ?> %</td>
			<td><?php echo $tsk->duration($task["Activity"]); ?></td>
			<td><?php echo $tsk->done($task["Task"]["enddate"]); ?></td>
		</tr>
<?php endforeach;?>
</table>

   <?php echo $html->link("Add Task" , array('controller' => 'tasks' , 'action' => 'add', 0 ,$tasks[0]["User"]["id"] , true ) , array('class'=>'buttonlink') ); ?>

