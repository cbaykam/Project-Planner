<div id="pagetitle"><h1>
	<?php if($project["Project"]["redalto"] == 1):?>
		<?php echo $project["Project"]["name"] ?>
	<?php else:?>
		<?php echo $project["Project"]["customer"] . ': ' . $project["Project"]["name"] ?>
	<?php endif;?>

</h1></div>
	
	<div id="projectLeftSide">
			<!--Project Overview -->
			<div id="projectOverview">
				<fieldset>
				<table style="width:98%; padding:0 0 0 0;">
					<tr><th class="noborder">Project Overview</th></tr>
					<tr><td class="noborder"><?php echo $project["Project"]["overview"]; ?></td></tr>
					
				</table>
				</fieldset>
				<br><br>
			</div>
			<!--Project milesontes-->
			<div id="projectKeyMilestones">
			<h3>Key Milestones</h3>
				<?php if (count($project['Milestone']) != 0): ?>
					<table class="pleftside">
						<tr>
							<th>Due Date</th>
							<th>Owner</th>
							<th>Description</th>
							<th>Status</th>
							<th width="70">Actions</th>
						</tr>
						<?php foreach($mlstns as $milestone):?>
					
							<?php if ($milestone['Milestone']['key'] == 1): ?>	
								<tr>
									<td><?php echo $timecal->format($milestone['Milestone']['enddate']); ?></td>
									<td class="tdformdiv">
										<?php if (isset($milestone['User']['name'])): ?>
											<?php echo $milestone['User']['name']; ?>
										<?php else: ?>
											<?php echo $form->create("Milestone" , array('url'=>array('controller'=>'milestones' , 'action'=>'assign' ,  $milestone['Milestone']["id"] , $project["Project"]["id"]) ) ); ?>
									 			--
										<?php endif; ?>
									</td>
									<td style="background:<?php echo $milestone['Milestone']['color'];?>;"><?php echo $html->link($milestone['Milestone']['name'] , array('controller'=>'milestones' , 'action'=>'view', $milestone['Milestone']["id"])); ?></td>
									<td><?php echo $milestone['Milestone']['status']; ?></td>
									<td><?php echo $html->link($html->image('ico_modify.gif') , array('controller' => 'milestones' , 'action' => 'edit', $milestone['Milestone']["id"], $project["Project"]["id"]) , null , null , false ); ?> <?php echo $html->link($html->image('ico_delete.gif') , array('controller' => 'milestones' , 'action' => 'delete', $milestone['Milestone']["id"], $project["Project"]["id"]) , null, sprintf(__('Are you sure you want to delete %s?', true) , $milestone['Milestone']['name'] ), null , false ); ?></td>
								</tr>
						<?php endif; ?>
					
					<?php endforeach;?>
					
				</table>
				<br><br>
				<div align="right" style="width:95%;">
				</div>
				<br><br>
			</div>
			<?php else: ?>
				<div align="right" style="width:95%;">
				</div></div>
			<?php endif; ?>
			<!--Tasks of the project-->
			<div id="tasks_in_project">
				
						<?php if (count($project["Task"])): ?>
							<h3>Tasks in the project</h3>
							<table style="width:95%;">
								<tr>
									<th>Created</th>
									<th>Description</th>
									<th>Project Phase</th>
									<th>Priority</th>
									<th>Status</th>
									<th>Due</th>
									<th>Hours</th>
									<th>Owner</th>
									<th width="70">Actions</th>
								</tr>
							<?php foreach($tasks as $task):?>
								<?php if($task["Task"]["enddate"] == "0000-00-00"):?>
								<tr>
									<td><?php echo $timecal->format($task["Task"]["startdate"]); ?></td>
									<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view', $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
									<td><?php echo $task["Milestone"]["name"]; ?></td>
									<td><?php echo $priority->display($task["Task"]["priority"]); ?></td>
									<td><?php echo $task["Task"]["status"]; ?> %</td>
									<td><?php echo $timecal->format($task["Task"]["duedate"]); ?></td>
									<td><?php echo $tsk->duration($task["Activity"]); ?></td>
									<?php if ($task["Task"]["user_id"] == 0): ?>
									 <td class="tdformdiv">
										--
									 </td>
									<?php else: ?>
										<td><?php echo $task["User"]["name"]; ?>
									<?php endif; ?>
									<td><?php echo $html->link($html->image('ico_delete.gif') , array('controller' => 'tasks' , 'action' => 'delete', $task["Task"]["id"] , $project["Project"]["id"]) , array() , "Please confirm that you want to permenantly remove this task" , null , false ); ?> <?php echo $html->link($html->image('ico_modify.gif') , array('controller' => 'tasks' , 'action' => 'edit', $task["Task"]["id"] , $project["Project"]["id"]), null , null , false ); ?> 
									<?php if($task["User"]["id"] == $user_idd):?>
										<?php echo $html->link("[c]" , array('controller'=>'tasks' , 'action'=>'complete', $task["Task"]["id"] , $project["Project"]["id"] ) , null , 'Are You sure you want to complete the task?')?></td>
									<?php endif;?>
								</tr>	
								<?php endif;?>	
							<?php endforeach;?>
							
							</table>
							<div align="right" style="width:95%;">
							<?php echo $html->link("View Completed Tasks" , array('controller'=>'tasks' , 'action'=>'viewcompleted', $project["Project"]["id"]))?></td></tr>
							</div>
							<div align="right" style="width:95%;">
							<?php echo $html->link("Add Another Task" , array('controller' => 'tasks' , 'action' => 'add', $project["Project"]["id"] , 0), array('class'=>'buttonlink') ); ?>
							</div>
						<?php else: ?>
							<div align="right" style="width:95%;">
							 <?php echo $html->link("Add A Task" , array('controller' => 'tasks' , 'action' => 'add', $project["Project"]["id"] , 0), array('class'=>'buttonlink') ); ?> 
							</div>
						<?php endif; ?>
			</div>
			<div id="users_in_project">
				<?php if (count($project["User"]) != 0): ?>
					<table style="width:95%">
					<thead>
						<th style="width:30%;">Users in the Project</th>
					</thead>
					<?php foreach($project["User"] as $usr):?>
						<tr>
							<td><?php echo $usr["name"]; ?></td>
						</tr>
					<?php endforeach;?>
					</table>
				<?php else: ?>
					No Users In the project please use the form below to add one.
				<?php endif; ?>
			</div>	
						
	</div>
	<!--Start of the right side Div-->
	<div id="projectRightSide2">
			<!--Project Notices-->
			
			<!--Links of the project-->
			<div id="project_links_menu">
				<?php if (count($project["Link"]) != 0): ?>
					
						<table style="width:95%;" cellpadding="0" cellspacing="0">
							<tr>
								<th class="noborder">Project Links</th>
							</tr>
							<tr>
								<td><b>Link</b></th>
							</tr>
						<?php foreach($project["Link"] as $link):?>
							<tr>
								<td><a href="<?php echo $link['link'] ?>"><?php echo $link["name"]; ?></td>
							</tr>
						<?php endforeach;?>	
						</table>
						<br><br>
				<?php else: ?>
					<?php echo $html->link("Add Link" , array('controller' => 'links' , 'action' => 'add', $project["Project"]["id"] ), array('class'=>'buttonlink') ); ?>
				<?php endif; ?>	
			</div>
			<!--For updating project status-->
			<div id="projectStatus">
				<?php $countstats = count($project["Statuss"]); ?>
				<?php if ( $countstats == 0): ?>
				<?php else: ?>
				    <?php $statindice = $countstats - 1; ?>
					<table style="width:95%;" cellpadding="0" cellspacing="0">
						<tr><th>Project Status</th><th></th></tr>
						<tr>
							<td><?php echo $project["Statuss"][$statindice]['created'] ?></td>
							<td><?php echo $project["Statuss"][$statindice]['status'] ?></td>
						</tr>
						<tr>
							<td></td><th><?php echo $html->link("View Archive" , array('controller' => 'statusses' , 'action' => 'view', $project["Project"]["id"]) ); ?></th>
						</tr>
					</table>
					<br><br>	
				<?php endif; ?>
				
			</div>
			<!--Show the budgeting.-->
			<div id="budgeting">
				<table style="width:95%;" cellpadding="0" cellspacing="0">
					<tr>
						<th>Budgeting</th>
						<th></th>
					</tr>
					<tr>
						<td>Hours Budgeted</td>
						<td><?php echo $timecal->show($project["Project"]["budget"]); ?></td>
					</tr>
					<tr>
						<td>Hours Worked</td>
						<td><?php echo $timecal->show($sumhours); ?></td>
					</tr>
				</table>
		
			</div>
   
   			
	</div>
	
	<!--Show users in the project-->
	
