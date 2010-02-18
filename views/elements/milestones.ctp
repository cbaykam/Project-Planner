<br><br>
<a href='' id='removeMilestones'>Remove Milestones</a>
<hr>
<?php $i = 0;?>
<?php foreach($stmileston as $stmlstns):?>
	<?php
		$mlname = 'Milestone.' . $i . '.name';
		$mlstart = 'Milestone.' . $i . '.startdate';
		$mlend = 'Milestone.' . $i . '.enddate';
		$mlkey = 'Milestone.' . $i . '.key';
		$mlstats = 'Milestone.' . $i . '.status';
		$mlclr = 'Milestone.' . $i . '.color';
		$mlorder = $i + 1 ;
		$mlordernm = 'Milestone.' . $i . '.order';
		$i++ ;
	?>
	<?php echo $form->input($mlname , array('label'=>'Description' , 'value'=>$stmlstns["Standart"]["name"]) ); ?>
	<?php echo $form->input($mlstart); ?>
	<?php echo $form->input($mlend); ?>
	<?php echo $form->input($mlkey , array('value'=>'1' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlstats , array('value'=>'Not Yet Started' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlclr , array('type'=>'hidden', 'value'=>$stmlstns["Standart"]["color"])) ?>
	<?php echo $form->input($mlordernm , array('type'=>'hidden', 'value'=>$mlorder)) ?>
	<hr>
<?php endforeach;?>
<?php echo $form->input('milestone' , array('type'=>'hidden', 'value'=>'1')) ?>
<a href='' id='removeMilestones'>Remove Milestones</a>
