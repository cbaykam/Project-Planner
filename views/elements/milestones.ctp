<h3>Add Standard Milestones</h3>
<hr>
<?php $i = 0;?>
<?php foreach($stmileston as $stmlstns):?>
	<?php
		$mladd = 'Milestone.' . $i . '.add';
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
	<label for="Milestone<?php echo $i-1?>Add">Add This</label>
	<input type="checkbox" id="Milestone<?php echo $i-1?>Add" value="1" name="data[Milestone][<?php echo $i-1?>][add]">
	<?php echo $form->input($mlname , array('label'=>'Description' , 'value'=>$stmlstns["Standart"]["name"]) ); ?>
	<?php echo $form->input($mlstart, array('dateFormat'=>'DMY')); ?>
	<?php echo $form->input($mlend, array('dateFormat'=>'DMY')); ?>
	<?php echo $form->input($mlkey , array('value'=>'1' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlstats , array('value'=>'Not Yet Started' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlclr , array('type'=>'hidden', 'value'=>$stmlstns["Standart"]["color"])) ?>
	<?php echo $form->input($mlordernm , array('type'=>'hidden', 'value'=>$mlorder)) ?>
	<hr>
<?php endforeach;?>
<?php echo $form->input('milestone' , array('type'=>'hidden', 'value'=>'1')) ?>