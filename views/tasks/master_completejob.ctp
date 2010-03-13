<h1><?php echo $tsk->dispProj($pdata, $task["Task"]["type"]);?> <?php echo $html->link('Return To Jobs' , array('controller'=>'tasks' , 'action'=>'indexjobs' , 'master'=>true , $redalto)) ?></h1>
<div id="pagetitle"><h1>Complete Task : <?php echo $tdata["Task"]["name"]?></h1></div>
<div id="projectLeftSide">

<?php echo $form->create('Task', array('url'=>array('controller'=>'tasks' , 'action'=>'completejob' , 'master'=>true, $this->params["pass"][0] , $this->params["pass"][1]))); ?>
<?php echo $form->input('id' , array('value'=>$tdata["Task"]["id"]))?>
<?php echo $form->input('enddate' , array('label'=>'Date of Completion'))?>
<?php echo $form->end('Submit')?>
</div>

