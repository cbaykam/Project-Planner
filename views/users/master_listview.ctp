
<div id="pagetitlem"><h1><?php __('Resources');?></h1></div>

<div id="projectLeftSidem">
<p>
<?php
echo $paginator->counter(array(
'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
));
?></p>
<table width="95%">
<tr>
	<th><?php echo $paginator->sort('name');?></th>
	<th><?php echo $paginator->sort('email');?></th>
	<th><?php echo $paginator->sort('Phone','pwork');?></th>
	<th><?php echo $paginator->sort('Mobile','pmobile');?></th>
	<th><?php echo $paginator->sort('messenger');?></th>
	<th><?php echo $paginator->sort('skype');?></th>
	<th><?php echo $paginator->sort('User', 'admin');?></th>
	<?php if (!isset($this->params["pass"][0])): ?>
	<th><?php echo $paginator->sort('View Tasks');?></th>
	<?php endif; ?>
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
			<?php echo $html->link($user['User']['name'] , array('controller' => 'users' , 'action' => 'view','master'=>true , $user['User']['id']) ); ?>
		</td>
		<td>
			<?php echo $user['User']['email']; ?>
		</td>
		<td>
			<?php echo $user['User']['pwork']; ?>
		</td>
		<td>
			<?php echo $user['User']['pmobile']; ?>
		</td>
		<td>
			<?php echo $user['User']['messenger']; ?>
		</td>
		<td>
			<?php echo $user['User']['skype']; ?>
		</td>
		<td>
			<?php echo $usr->rights($user['User']['admin']); ?>
		</td>
		<?php if (!isset($this->params["pass"][0])): ?>
		<td>			
				<?php echo $html->link("View Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser', 'master'=>true , $user['User']['id']) );; ?>	
		</td>
		<?php endif; ?>
		<td class="actions">
			<?php echo $html->link($html->image("ico_modify.gif"), array('action'=>'edit', $user['User']['id']) , null , null , false); ?>
			<?php echo $html->link($html->image("ico_delete.gif"), array('action'=>'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete '.$user['User']['name'].'?', true), $user['User']['id']) , null , false); ?>
		</td>
	</tr>
<?php endforeach; ?>
</table>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previous', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('next', true).' >>', array(), null, array('class'=>'disabled'));?>
</div>
<?php echo $html->link(__('Add Resource', true), array('controller'=>'users' , 'action'=>'add','master'=>true) , array('class'=>'buttonlink')); ?>
</div>


</div>
