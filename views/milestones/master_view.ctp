<div class="milestones view">
<h2><?php  __('Milestone');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $milestone['Milestone']['project_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit Milestone', true), array('action'=>'edit', $milestone['Milestone']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete Milestone', true), array('action'=>'delete', $milestone['Milestone']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $milestone['Milestone']['id'])); ?> </li>
		<li><?php echo $html->link(__('List Milestones', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New Milestone', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
