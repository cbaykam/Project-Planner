<div class="tasks index">
<h2><?php __('Tasks');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table cellpadding="0" cellspacing="0">
<tr>
	<th><?php echo $paginator->sort('id');?></th>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('type');?></th>
	<th><?php echo $paginator->sort('description');?></th>
	<th><?php echo $paginator->sort('duedate');?></th>
	<th><?php echo $paginator->sort('resource_id');?></th>
	<th><?php echo $paginator->sort('dependency');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($tasks as $task):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $task['Task']['id']; ?>
		</td>
		<td>
			<?php echo $task['Task']['name']; ?>
		</td>
		<td>
			<?php echo $task['Task']['project_id']; ?>
		</td>
		<td>
			<?php echo $task['Task']['status']; ?>
		</td>
		<td>
			<?php echo $task['Task']['priority']; ?>
		</td>
		<td>
			<?php echo $task['Task']['type']; ?>
		</td>
		<td>
			<?php echo $task['Task']['description']; ?>
		</td>
		<td>
			<?php echo $task['Task']['duedate']; ?>
		</td>
		<td>
			<?php echo $task['Task']['resource_id']; ?>
		</td>
		<td>
			<?php echo $task['Task']['dependency']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $task['Task']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $task['Task']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $task['Task']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $task['Task']['id'])); ?>
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
		<li><?php echo $html->link(__('New Task', true), array('action'=>'add')); ?></li>
	</ul>
</div>
