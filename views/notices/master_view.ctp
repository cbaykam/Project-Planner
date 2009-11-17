<div class="notices view">
<h2><?php  __('Notice');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $notice['Notice']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $notice['Notice']['project_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Noticescol'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $notice['Notice']['noticescol']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Notice', true), array('action'=>'edit', $notice['Notice']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Notice', true), array('action'=>'delete', $notice['Notice']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $notice['Notice']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Notices', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Notice', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
