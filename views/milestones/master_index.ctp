<div id="pagetitle"><h1><?php __('Milestones');?> </h1></div>
<div id="projectLeftSide">

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
	<th><?php echo $paginator->sort('startdate');?></th>
	<th><?php echo $paginator->sort('enddate');?></th>
	<th><?php echo $paginator->sort('status');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($milestones as $milestone):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $milestone['Milestone']['id']; ?>
		</td>
		<td>
			<?php echo $milestone['Milestone']['name']; ?>
		</td>
		<td>
			<?php echo $milestone['Project']['name']; ?>
		</td>
		<td>
			<?php echo $milestone['Milestone']['startdate']; ?>
		</td>
		<td>
			<?php echo $milestone['Milestone']['enddate']; ?>
		</td>
		<td>
			<?php echo $milestone['Milestone']['status']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link($html->image("ico_modify.gif"), array('action'=>'edit', $milestone['Milestone']['id'] , $this->params["pass"][0]) , null , null , false); ?>
			<?php echo $html->link($html->image("ico_delete.gif"), array('action'=>'delete', $milestone['Milestone']['id'], $this->params["pass"][0]), null, sprintf(__('Are you sure you want to delete %s?', true), $milestone['Milestone']['name']) , null , false); ?>
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

