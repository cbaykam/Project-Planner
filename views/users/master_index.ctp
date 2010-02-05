<?php $paginator->options(array('url' => $this->passedArgs));?>
<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<?php if ($iscustomer != 1): ?>
<?php echo $html->link(__('Add Resource', true), array('controller'=>'users' , 'action'=>'add','master'=>true) , array('class'=>'buttonlink')); ?>
<?php else: ?>
<?php echo $html->link(__('Add Customer', true), array('controller'=>'users' , 'action'=>'add','master'=>true , 1) , array('class'=>'buttonlink')); ?>
<?php endif; ?>
<br><br>
<div class="users index">
<?php if ($iscustomer != 1): ?>
<h2><?php __('Resources');?></h2>
<?php else: ?>
<h2><?php __('Customers');?></h2>
<?php endif; ?>

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
	<th><?php echo $paginator->sort('Phone' , 'pwork');?></th>
	<th><?php echo $paginator->sort( 'Mobile' , 'pmobile');?></th>
	<th><?php echo $paginator->sort('messenger');?></th>
	<th><?php echo $paginator->sort('skype');?></th>
	<?php if ($iscustomer != 1): ?>
	<th><?php echo $paginator->sort('View Tasks');?></th>
	<?php else:?>
	<th><?php echo $paginator->sort('website');?></th>
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
			<?php echo $user['User']['id']; ?>
		</td>
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
		<?php if ($iscustomer != 1): ?>
		<td>			
				<?php echo $html->link("View Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser', 'master'=>true , $user['User']['id']) );; ?>	
		</td>
		<?php else: ?>
		<td>
			<?php echo $user['User']['website']; ?>
		</td>
		<?php endif; ?>
		<td class="actions">
			<?php echo $html->link(__('Edit', true), array('action'=>'edit', $user['User']['id'])); ?>
			<?php echo $html->link(__('Delete', true), array('action'=>'delete', $user['User']['id'] , $iscustomer), null, sprintf(__('Are you sure you want to delete '.$user['User']['name'].'?', true), $user['User']['id'])); ?>
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

<?php if ($timeline): ?>
	<h3>Resourcing</h3>

	 <div id="vacationcolor">Holiday / Vacation</div>
	 <div id="othercolor">unavailable (other reason)</div>
	 
	 <a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 
<?php endif; ?>
