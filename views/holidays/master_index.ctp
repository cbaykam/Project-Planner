<div class="holidays index">
<h2><?php __('Holidays');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('start');?></th>
	<th><?php echo $paginator->sort('end');?></th>
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($holidays as $holiday):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $holiday['Holiday']['id']; ?>
		</td>
		<td>
			<?php echo $holiday['Holiday']['description']; ?>
		</td>
		<td>
			<?php echo $holiday['Holiday']['start']; ?>
		</td>
		<td>
			<?php echo $holiday['Holiday']['end']; ?>
		</td>
		<td>
			<?php echo $holiday['Holiday']['user_id']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $holiday['Holiday']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $holiday['Holiday']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $holiday['Holiday']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $holiday['Holiday']['id'])); ?>
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
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('New Holiday', true), array('action'=>'add')); ?></li>
	</ul>
</div>
