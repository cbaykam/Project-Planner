<div class="bugs index">
<h2><?php __('Bugs');?></h2>
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table>
<tr>
	<th><?php echo $paginator->sort('created');?></th>
	<th><?php echo $paginator->sort('priority');?></th>
	<th><?php echo $paginator->sort('project_id');?></th>
	<th><?php echo $paginator->sort('title');?></th>		
	<th><?php echo $paginator->sort('user_id');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($bugs as $bug):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $bug['Bug']['created']; ?>
		</td>
		<td>
			<?php echo $html->link($priority->display($bug['Bug']['priority']) , array('controller' => 'bugs' , 'action' => 'filter', 'master'=>true, 'priority'=>$bug['Bug']['priority'], 'redalto'=>$this->params["named"]['redalto']) ); ?>
		</td>
		<td>
			<?php echo $html->link($bug['Project']['name'] , array('controller' => 'bugs' , 'action' => 'filter', 'master'=>true , 'project'=>$bug['Project']['id'], 'redalto'=>$this->params["named"]['redalto']) ); ?>
		</td>
		<td>
			<?php echo $bug['Bug']['description']; ?>
		</td>	
		<td>
			<?php echo $html->link($bug['User']['name'] , array('controller' => 'bugs' , 'action' => 'filter','master'=>true , 'user'=>$bug['User']['id'], 'redalto'=>$this->params["named"]['redalto']) ); ?>
		</td>
		
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $bug['Bug']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $bug['Bug']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $bug['Bug']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bug['Bug']['id'])); ?>
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
