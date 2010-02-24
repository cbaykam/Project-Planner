<h2><?php  __('Project');?> : <?php echo $project["Project"]["name"] ?></h2>
	
	<div id="projectLeftSide">
			<!--Project Overview -->
			<div id="projectOverview">
				<table class="pleftside">
					<tr><th class="noborder">Project Overview</th><th class="nobordercorner"></th></tr>
					<tr><td class="noborder"><?php echo $project["Project"]["overview"]; ?></td><td></td></tr>
					
				</table>
				
			</div>
			<!--Project milesontes-->
			<div id="projectKeyMilestones">
			
				<?php if (count($project['Milestone']) != 0): ?>
					<table class="pleftside">
						<tr><th class="noborder">Key Milestones</th><th class="noborder"></th><th class="noborder"></th><th class="noborder"></th><th class="nobordercorner"></th></tr>
						<tr>
							<th>Due Date</th>
							<th>Owner</th>
							<th>Description</th>
							<th>Status</th>
							<th>Completed</th>
						</tr>
						<?php foreach($project['Milestone'] as $milestone):?>
					
							<?php if ($milestone['key'] == 1): ?>	
								<tr>
									<td><?php echo $timecal->format($milestone['enddate']); ?></td>
									<td width="200">
										<?php if (isset($milestone['User']['name'])): ?>
											<?php echo $milestone['User']['name']; ?>
										<?php else: ?>
											No One			 			
										<?php endif; ?>
									</td>
									<td style="background:<?php echo $milestone['color'];?>;"><?php echo $milestone['name']; ?></td>
									<td><?php echo $milestone['status']; ?></td>
									<td>
										<?php if ($milestone['completed'] != '0000-00-00'): ?>
											<?php echo $milestone['completed']; ?>
										<?php else: ?>
											No
										<?php endif; ?>
									</td>
								</tr>
						<?php endif; ?>
					
					<?php endforeach;?>
					<tr>
						<td></td><td></td><td></td><td></td>
						<th><?php echo $html->link('View All Milestones' , array('controller' => 'milestones' , 'action' => 'index',  $project['Project']['id']) ); ?></th>
					</tr>
				</table>
			</div>
			<?php else: ?>
				<?php echo $html->link("Add Milestone" , array('controller' => 'milestones' , 'action' => 'add', $project["Project"]["id"]), array('class'=>'buttonlink') ); ?>
				</div>
			<?php endif; ?>
			<!--Tasks of the project-->
			<div id="tasks_in_project">
				
						<?php if (count($project["Task"])): ?>
							<h3>Tasks in the project</h3>
							<table style="width:95%;">
								<tr>
									<th>Id</th>
									<th>Created</th>
									<th>Description</th>
									<th>Project Phase</th>
									<th>Priority</th>
									<th>Status</th>
									<th>Due</th>
									<th>Hours</th>
									<th>Owner</th>
									<th>Completed</th>
									<th>Actions</th>
								</tr>
							<?php foreach($tasks as $task):?>
			
								<tr>
									<td><?php echo $task["Task"]["id"]; ?></td>
									<td><?php echo $timecal->format($task["Task"]["created"]); ?></td>
									<?php if($task["User"]["id"] == $user_idd):?>
									<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view', $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
									<?php else:?>
									<td><?php echo $task["Task"]["name"]?></td>
									<?php endif;?>
									<td><?php echo $task["Milestone"]["name"]; ?></td>
									<td><?php echo $priority->display($task["Task"]["priority"]); ?></td>
									<td><?php echo $task["Task"]["status"]; ?> %</td>
									<td><?php echo $timecal->format($task["Task"]["duedate"]); ?></td>
									<td><?php echo $tsk->duration($task["Activity"]); ?></td>
									<?php if ($task["Task"]["user_id"] == 0): ?>
									 <td>
										<?php echo $form->create("Task" , array('url'=>array('controller'=>'tasks' , 'action'=>'assign' ,  $task["Task"]["id"] , $project["Project"]["id"]) ) ); ?>
										 <select id="TaskUsersa" name="data[Task][usersa]">
										   <option value="">Select one</option>
										  <?php foreach($usersa as $option):?>
										  	 <option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
										  <?php endforeach;?>
										 </select>
										 <input type="submit" value="assign" class="submitassign"/> 
										 </form>
									 </td>
									<?php else: ?>
										<td><?php echo $task["User"]["name"]; ?>
									<?php endif; ?>
									<td><?php echo $tsk->done($task["Task"]["enddate"]); ?></td>
									<?php if($task["User"]["id"] == $user_idd):?>
									<td><?php echo $html->link("[e]" , array('controller' => 'tasks' , 'action' => 'edit', $task["Task"]["id"] , $project["Project"]["id"]) ); ?> | <?php echo $html->link("[c]" , array('controller' => 'tasks' , 'action' => 'complete' , $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
									<?php else:?>
									<td></td>
									<?php endif;?>
								</tr>		
							<?php endforeach;?>
							</table>
					
							<?php echo $html->link("Add A Task for Yourself" , array('controller' => 'tasks' , 'action' => 'add', $project["Project"]["id"] , $user_idd), array('class'=>'buttonlink') ); ?>
					
						<?php else: ?>
		
							 <?php echo $html->link("Add A Task" , array('controller' => 'tasks' , 'action' => 'add' , $project["Project"]["id"] , $user_idd), array('class'=>'buttonlink') ); ?> 
						<?php endif; ?>
			</div>
			<div id="users_in_project">
				<?php if (count($project["User"]) != 0): ?>
					<table style="width:95%">
					<thead>
						<th style="width:70%;">Users in the Project</th>
					</thead>
					<?php foreach($project["User"] as $usr):?>
						<tr>
							<?php if($usr["id"] == $user_idd):?>
							<td><?php echo $html->link($usr["name"] , array('controller' => 'users' , 'action' => 'view', $usr["id"]) ); ?></td>
							<?php else:?>
									<td><?php echo $usr["name"]?></td>
							<?php endif;?>
						</tr>
					<?php endforeach;?>
					</table>
				<?php else: ?>
					No Users In the project please use the form below to add one.
				<?php endif; ?>
				
			</div>	
						
	</div>
	<!--Start of the right side Div-->
	<div id="projectRightSide">
			<!--Project Notices-->
			
			<div id="project_notices">
				<?php echo $html->link("View Notices" , array('controller' => 'notices' , 'action' => 'view', $project["Project"]["id"]), array('class'=>'buttonlink') ); ?>
				
				
				<?php if (count($project["Notice"]) != 0 ): ?>
					<table style="width:95%;">
						<tr>
							<th>Date</th>
							<th>Notice</th>
						</tr>
						
						<?php foreach($project["Notice"] as $notice):?>
					
								<tr>
									<td><?php echo $notice["created"]; ?></td>
									<td><?php echo $notice["title"]; ?></td>
								</tr>
					
						<?php endforeach;?>			
					</table>
				<?php endif; ?>
			</div>
			<!--Links of the project-->
			<div id="project_links_menu">
				<?php if (count($project["Link"]) != 0): ?>
						<table style="width:95%;">
							<tr>
								<th class="noborder">Project Links</th><th class="noborder"></th><th class="nobordercorner"><?php echo $html->link("Add Link" , array('controller' => 'links' , 'action' => 'add',$project["Project"]["id"] ) ); ?></th>
							</tr>
							<tr>
								<th>Name</th>
								<th>Link</th>
								<th>Actions</th>
							</tr>
						<?php foreach($project["Link"] as $link):?>
							<tr>
								<td><?php echo $link["name"]; ?></td>
								<td><a href="<?php echo $link['link'] ?>"><?php echo $link['link'] ?></td>
							</tr>
						<?php endforeach;?>	
						</table>
				<?php else: ?>
				<?php endif; ?>	
			</div>
			<!--For updating project status-->
			<div id="projectStatus">
				<?php $countstats = count($project["Statuss"]); ?>
				<?php if ( $countstats == 0): ?>
				<?php else: ?>
				    <?php $statindice = $countstats - 1; ?>
					<table style="width:95%;">
						<tr><th>Project Status</th><th><?php echo $html->link("Change" , array('controller' => 'statusses' , 'action' => 'add' , $project["Project"]["id"]) ); ?></th></tr>
						<tr>
							<td><?php echo $project["Statuss"][$statindice]['created'] ?></td>
							<td><?php echo $project["Statuss"][$statindice]['status'] ?></td>
						</tr>
						<tr>
							<td></td><th><?php echo $html->link("View Archive" , array('controller' => 'statusses' , 'action' => 'view', $project["Project"]["id"]) ); ?></th>
						</tr>
					</table>
					
				<?php endif; ?>
			</div>
			<!--Show the budgeting.-->
			<div id="budgeting">
				<table style="width:95%;">
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
	

