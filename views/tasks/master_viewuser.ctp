<h2>Tasks For User : <?php echo $html->link($tasks[0]["User"]["name"] , array('controller' => 'users' , 'action' => 'view','master'=>true , $tasks[0]["User"]["id"]) );  ?></h2>
<table border="0" cellspacing="0" cellpadding="0">
	<tr>
		<th>Task</th>
		<th>Project</th
	</tr>
<?php foreach($tasks as $task):?>
		<tr>
			<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["Task"]["id"] , $task["Project"]["id"]) );  ?></td>
			
		</tr>
<?php endforeach;?>
</table>
<div>
	<pre>
	   <?php print_r($tasks); ?>
	</pre>
</div>
