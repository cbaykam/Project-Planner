<?php $paginator->options(array('url' => $this->passedArgs));?>
<?php if($redalto == 0):?>
  <div id="pagetitle"><h1>Customer Support Jobs</h1>
  Tracking of customer operational support issues.
	</div>
<?php else:?>
  <div id="pagetitle"><h1>REDALTO JOBS</h1>
  Tracking of Redalto operational and future development issues.
  </div>  
<?php endif;?>
<div id="projectLeftSide">
<?php if($redalto == 0):?>
	<?php echo $html->link('Create job' , array('controller'=>'tasks' , 'action'=>'add' , 0 , 0 , 0 , 1 , 0) , array('class'=>'buttonlink'));?>
<?php else:?>
	<?php echo $html->link('Create job' , array('controller'=>'tasks' , 'action'=>'add' , 0 , 0 , 0 , 1 , 1) , array('class'=>'buttonlink'));?>
<?php endif;?>
<?php if(count($tasks) != 0):?> 
<table>
  <tr>
    <th><?php echo $paginator->sort('startdate');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('customer');?></th>
	<th><?php echo $paginator->sort('title');?></th>		
	<th><?php echo $paginator->sort('user_id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('datedone');?></th>
	<th><?php echo $paginator->sort('time');?></th>
	<?php if($redalto == 1):?>
	<th><?php echo $paginator->sort('approved');?></th>
	<?php endif;?>
	<th>Actions</th>
  </tr>
  <tr>
    <?php foreach($tasks as $task):?>
    	<tr>
    		<td><?php echo $timecal->format($task["Task"]["startdate"]);?></td>
    		<td><?php echo $priority->display($task["Task"]["priority"]);?></td>
    		<td><?php echo $task["Task"]["customer"];?></td>
    		<td><?php echo $html->link($task["Task"]["name"], array('controller'=>'tasks' , 'action'=>'view' ,$task["Task"]["id"]));?></td>
    		<td><?php echo $task["User"]["name"];?></td>
    		<td><?php echo $task["Task"]["status"];?> %</td>
    		<td><?php echo $tsk->done($task["Task"]["enddate"]);?></td>
    		<td><?php echo $tsk->duration($task["Activity"]); ?></td>
    			<?php if($redalto == 1):?>
    				<td><?php echo $tsk->approved($task["Task"]["approved"]); ?></td>
    			<?php endif;?>
    		<td>
    			<?php echo $html->link($html->image("ico_modify.gif") , array('controller'=>'tasks' , 'action'=>'jobedit',$task["Task"]['id'], $redalto)  , null , null , false); ?> 
    			<?php if($task["Task"]["enddate"] == '0000-00-00'):?>
    				<?php echo $html->link("complete" , array('controller'=>'tasks' , 'action'=>'completejob',$task["Task"]['id'], $redalto) , null , 'Are You Sure You want to complete job '. $task["Task"]['name'] .'?' , false); ?>
    			<?php else:?>
    				<?php echo $html->link("uncomplete" , array('controller'=>'tasks' , 'action'=>'uncompletejob',$task["Task"]['id'], $redalto) , null , 'Are You Sure You want to uncomplete job '. $task["Task"]['name'] .'?' , false); ?>
    			<?php endif;?>
    		</td>
    	</tr>
    <?php endforeach;?>
  </tr>
</table>
<?php endif;?>
</div>