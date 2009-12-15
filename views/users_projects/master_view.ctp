<div class="usersProjects view">
<h2><?php  __('UsersProject');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersProject['UsersProject']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersProject['UsersProject']['user_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Project Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $usersProject['UsersProject']['project_id']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<ul>
		<li><?php echo $html->link(__('Edit UsersProject', true), array('action'=>'edit', $usersProject['UsersProject']['id'])); ?> </li>
		<li><?php echo $html->link(__('Delete UsersProject', true), array('action'=>'delete', $usersProject['UsersProject']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $usersProject['UsersProject']['id'])); ?> </li>
		<li><?php echo $html->link(__('List UsersProjects', true), array('action'=>'index')); ?> </li>
		<li><?php echo $html->link(__('New UsersProject', true), array('action'=>'add')); ?> </li>
	</ul>
</div>
