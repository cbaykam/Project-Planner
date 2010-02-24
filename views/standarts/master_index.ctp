<div id="pagetitle"><h1><?php __('Standard Milestones');?></h1></div>
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
	<th><?php echo $paginator->sort('name');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php

foreach ($standarts as $standart):?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $standart['Standart']['id']; ?>
		</td>
		<td style="background-color:<?php echo $standart['Standart']['color']; ?>;">
			<?php echo $standart['Standart']['name']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $standart['Standart']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $standart['Standart']['id']), null, sprintf(__('Are you sure you want to delete %s?', true), $standart['Standart']['name'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>

		<?php echo $html->link(__('Add Standard Milestone', true), array('action'=>'add') , array('class'=>'buttonlink')); ?>
</div>
