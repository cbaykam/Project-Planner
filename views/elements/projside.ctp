<?php if ($adminuser): ?>

      <ul>
       <li><h2>Projects</h2></li>
      	<?php foreach($projectsOpen as $pr):?>
      	
      			<li><?php echo $html->link($pr["Project"]["name"] , array('controller' => 'projects' , 'action' => 'view' , $pr["Project"]["id"]) ); ?></li>
      	
      	<?php endforeach;?>
      </ul>
<?php else: ?>

<?php endif; ?>
