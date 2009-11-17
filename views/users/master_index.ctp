<div class="users index">
<h2><?php __('users');?></h2>
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
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('password');?></th>
	<th><?php echo $paginator->sort('pwork');?></th>
	<th><?php echo $paginator->sort('pmobile');?></th>
	<th><?php echo $paginator->sort('messenger');?></th>
	<th><?php echo $paginator->sort('skype');?></th>
	<th class="actions"><?php __('Actions');?></th>
</tr>
<?php
$i = 0;
foreach ($users as $user):
	$class = null;
	if ($i++ % 2 == 0) {
		$class = ' class="altrow"';
	}
?>
	<tr<?php echo $class;?>>
		<td>
			<?php echo $user['user']['id']; ?>
		</td>
		<td>
			<?php echo $user['user']['name']; ?>
		</td>
		<td>
			<?php echo $user['user']['email']; ?>
		</td>
		<td>
			<?php echo $user['user']['password']; ?>
		</td>
		<td>
			<?php echo $user['user']['pwork']; ?>
		</td>
		<td>
			<?php echo $user['user']['pmobile']; ?>
		</td>
		<td>
			<?php echo $user['user']['messenger']; ?>
		</td>
		<td>
			<?php echo $user['user']['skype']; ?>
		</td>
		<td class="actions">
			<?php echo $html->link(__('View', true), array('action'=>'view', $user['user']['id'])); ?>
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $user['user']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $user['user']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['user']['id'])); ?>
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
		<li><?php echo $html->link(__('New user', true), array('action'=>'add')); ?></li>
	</ul>
</div>
