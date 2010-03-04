<div id="pagetitle"><h1><?php __('Notices');?></h1></div>
<div id="projectLeftSide">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table>
<tr>
	<th><?php echo $paginator->sort('Title','title');?></th>
	<th><?php echo $paginator->sort('Message','noticescol');?></th>
	<th><?php echo $paginator->sort('date');?></th>
</tr>
<?php
$i = 0;
foreach ($notices as $notice):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $notice['Notice']['title']; ?>
		</td>
		<td>
			<?php echo $notice['Notice']['noticescol']; ?>
		</td>
		<td>
			<?php echo $timecal->format($notice['Notice']['date']); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
 </div>


	
   
	

