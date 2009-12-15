<div class="activities view">
<h2><?php  __('Activity');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activity['Activity']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Task Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activity['Activity']['task_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Duration'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activity['Activity']['duration']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $activity['Activity']['description']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Activity', true), array('action'=>'edit', $activity['Activity']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Activity', true), array('action'=>'delete', $activity['Activity']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $activity['Activity']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Activities', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Activity', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
