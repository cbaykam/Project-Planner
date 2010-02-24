<h3>Add Standard Milestones</h3>
<hr>
<?php $i = 0;?>
<?php foreach($stmileston as $stmlstns):?>
	<?php
		$mladd = 'Mile.' . $i . '.add';
		$mlname = 'Mile.' . $i . '.name';
		$mlstart = 'Mile.' . $i . '.startdate';
		$mlend = 'Mile.' . $i . '.enddate';
		$mlkey = 'Mile.' . $i . '.key';
		$mlstats = 'Mile.' . $i . '.status';
		$mlclr = 'Mile.' . $i . '.color';
		$mlorder = $i + 1 ;
		$mlordernm = 'Mile.' . $i . '.order';
		$i++ ;
	?>
	<label for="Mile<?php echo $i-1?>Add">Add This</label>
	<input type="checkbox" id="Mile<?php echo $i-1?>Add" value="1" name="data[Mile][<?php echo $i-1?>][add]">
	<?php echo $form->input($mlname , array('label'=>'Description' , 'value'=>$stmlstns["Standart"]["name"]) ); ?>
	<?php echo $form->input($mlstart , array('dateFormat'=>'DMY' , 'type'=>'date')); ?>
	<?php echo $form->input($mlend , array('dateFormat'=>'DMY' , 'type'=>'date')); ?>
	<?php echo $form->input($mlkey , array('value'=>'1' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlstats , array('value'=>'Not Yet Started' , 'type'=>'hidden')); ?>
	<?php echo $form->input($mlclr , array('type'=>'hidden', 'value'=>$stmlstns["Standart"]["color"])) ?>
	<?php echo $form->input($mlordernm , array('type'=>'hidden', 'value'=>$mlorder)) ?>
	<hr>
<?php endforeach;?>
<?php echo $form->input('milestone' , array('type'=>'hidden', 'value'=>'1')) ?>