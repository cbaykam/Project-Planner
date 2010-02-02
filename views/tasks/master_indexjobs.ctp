<?php if($redalto == 0):?>
  <h3>WEBSITE BUGS, MAINTENANCE & SUPPORT</h3>
  <?php echo $html->link('Add Request' , array('controller'=>'tasks' , 'action'=>'add' , 'master'=>true , 0 , 0 , 0 , 1 , 0) , array('class'=>'buttonlink'));?>
<?php else:?>
  <h3>REDALTO.APPS ISSUE TRACKER</h3>
    <?php echo $html->link('Add Request' , array('controller'=>'tasks' , 'action'=>'add' , 'master'=>true , 0 , 0 , 0 , 1 , 1) , array('class'=>'buttonlink'));?>
<?php endif;?>
<?php if(count($tasks) != 0):?> 
<table>
  <tr>
    <th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('customer');?></th>
	<th><?php echo $paginator->sort('title');?></th>		
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('datedone');?></th>
	<th><?php echo $paginator->sort('time');?></th>
	<th>Actions</th>
  </tr>
  <tr>
    <?php foreach($tasks as $task):?>
    	<tr>
    		<td><?php echo $timecal->format($task["Task"]["created"]);?></td>
    		<td><?php echo $priority->display($task["Task"]["priority"]);?></td>
    		<td><?php echo $task["Task"]["customer"];?></td>
    		<td><?php echo $html->link($task["Task"]["name"], array('controller'=>'tasks' , 'action'=>'view' ,'master'=>true , $task["Task"]["id"]));?></td>
    		<td><?php echo $task["User"]["name"];?></td>
    		<td><?php echo $task["Task"]["status"];?> %</td>
    		<td><?php echo $tsk->done($task["Task"]["enddate"]);?></td>
    		<td><?php echo $tsk->duration($task["Activity"]); ?></td>
    		<td>
    			<?php echo $html->link('Edit' , array('controller'=>'tasks' , 'action'=>'jobedit','master'=>true ,$task["Task"]['id'], $redalto)); ?> |
    			<?php echo $html->link('Delete' , array('controller'=>'tasks' , 'action'=>'delete','master'=>true ,$task["Task"]['id'], 0,$redalto) , null , 'Are You Sure You want to delete job '. $task["Task"]['name'] .'?'); ?>
    		</td>
    	</tr>
    <?php endforeach;?>
  </tr>
</table>
<?php endif;?>
