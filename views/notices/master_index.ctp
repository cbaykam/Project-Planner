<div class="notices index">
<h2><?php __('Notices');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('title');?></th>
	<th><?php echo $paginator->sort('noticescol');?></th>
	<th class="actions"><?php __('Actions');?></th>
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
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $notice['Notice']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $notice['Notice']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $notice['Notice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $notice['Notice']['id'])); ?>
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
	
    <?php echo $html->link(__('New Notice', true), array('action'=>'add') , array('class'=>'buttonlink'')); ?>
	
</div>
