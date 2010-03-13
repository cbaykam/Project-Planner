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
    		<td><?php echo $html->link($task["Task"]["name"], array('controller'=>'tasks' , 'action'=>'view' ,'master'=>true , $task["Task"]["id"]));?></td>
    		<td><?php echo $task["User"]["name"];?></td>
    		<td><?php echo $task["Task"]["status"];?> %</td>
    		<td><?php echo $tsk->done($task["Task"]["enddate"]);?></td>
    		<td><?php echo $tsk->duration($task["Activity"]); ?></td>
    			<?php if($redalto == 1):?>
    				<td><?php echo $tsk->approved($task["Task"]["approved"]); ?></td>
    			<?php endif;?>
    		<td>
    			<?php echo $html->link($html->image("ico_modify.gif") , array('controller'=>'tasks' , 'action'=>'jobedit','master'=>true ,$task["Task"]['id'], $redalto)  , null , null , false); ?> 
    			<?php echo $html->link($html->image("ico_delete.gif") , array('controller'=>'tasks' , 'action'=>'delete','master'=>true ,$task["Task"]['id'], 0,$redalto) , null , 'Are You Sure You want to delete job '. $task["Task"]['name'] .'?' , false); ?>
    			<?php if($task["Task"]["enddate"] == '0000-00-00'):?>
    				<?php echo $html->link("complete" , array('controller'=>'tasks' , 'action'=>'completejob','master'=>true ,$task["Task"]['id'], $redalto) , null , 'Are You Sure You want to complete job '. $task["Task"]['name'] .'?' , false); ?>
    			<?php else:?>
    				<?php echo $html->link("uncomplete" , array('controller'=>'tasks' , 'action'=>'uncompletejob','master'=>true ,$task["Task"]['id'], $redalto) , null , 'Are You Sure You want to uncomplete job '. $task["Task"]['name'] .'?' , false); ?>
    			<?php endif;?>
    			
    			<?php if($redalto == 1):?>
    				| <?php echo $html->link('Approve' , array('controller'=>'tasks' , 'action'=>'redaltoapprove','master'=>true ,$task["Task"]['id']) , null , 'This Will approve the job '. $task["Task"]['name'] .'?'); ?>
    			<?php endif;?>
    		</td>
    	</tr>
    <?php endforeach;?>
  </tr>
</table>
<?php endif;?>
<?php echo $html->link('View Active jobs' , array('controller'=>'tasks' , 'action'=>'indexjobs' , 'master'=>true , $redalto) , array('class'=>'buttonlink'))?>
</div>