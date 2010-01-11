<div class="holidays view">
<h2><?php  __('Holiday');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $holiday['Holiday']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Description'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $holiday['Holiday']['description']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Start'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $holiday['Holiday']['start']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('End'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $holiday['Holiday']['end']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $holiday['Holiday']['user_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Holiday', true), array('action'=>'edit', $holiday['Holiday']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Holiday', true), array('action'=>'delete', $holiday['Holiday']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $holiday['Holiday']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Holidays', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Holiday', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
