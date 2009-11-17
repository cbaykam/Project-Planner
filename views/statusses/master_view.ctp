<div class="statusses view">
<h2><?php  __('Statuss');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuss['Statuss']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuss['Statuss']['project_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuss['Statuss']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $statuss['Statuss']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Statuss', true), array('action'=>'edit', $statuss['Statuss']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Statuss', true), array('action'=>'delete', $statuss['Statuss']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $statuss['Statuss']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Statusses', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Statuss', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
