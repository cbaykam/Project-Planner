<div id="pagetitle"><h1><?php __('Activities');?></h1></div>
<div id="projectLeftSide">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table>
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('task_id');?></th>
	<th><?php echo $paginator->sort('duration');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($activities as $activity):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $activity['Activity']['id']; ?>
		</td>
		<td>
			<?php echo $activity['Activity']['task_id']; ?>
		</td>
		<td>
			<?php echo $activity['Activity']['duration']; ?>
		</td>
		<td>
			<?php echo $activity['Activity']['description']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $activity['Activity']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $activity['Activity']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $activity['Activity']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $activity['Activity']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
</div>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>