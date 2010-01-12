<div class="notices view">

	<?php foreach($data as $notice):?>
	
		<table border="0" cellspacing="0" cellpadding="0" style="width:600px;">
			<tr>
			    <th style="width:70px;"><?php echo $notice["Notice"]["created"]; ?></th>
			    <th><?php echo $notice["Notice"]["title"]; ?></th>
			</tr>
			<tr><td></td><td><?php echo $notice["Notice"]["noticescol"]; ?></td></tr>
			<?php if ($notice["Notice"]["project_id"] != 0): ?>
				<tr><td>
					<!--Check if the project is a redalto project or not-->
					<?php if ($notice["Project"]["redalto"]): ?>
						Redalto Project 
					<?php else: ?>
						Customer Project
					<?php endif; ?>
					<!--the project title Css this part-->
				</td><td><?php echo $notice["Project"]["name"]; ?></td>
				</tr>	
			<?php endif; ?>	
		</table>			
		<br><br>
	<?php endforeach;?>
</div>
