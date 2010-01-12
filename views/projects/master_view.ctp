<div class="projects view">
<h2><?php  __('Project');?> : <?php echo $project["Project"]["name"] ?></h2>
	
	<div id="projectLeftSide">
			<!--Project Overview -->
			<div id="projectOverview">
				<table border="0" cellspacing="0" cellpadding="0" class="pleftside">
					<tr><th class="noborder">Project Overview</th><th class="nobordercorner"><?php echo $html->link("Edit" , array('controller' => 'projects' , 'action' => 'changeover','master'=>true , $project["Project"]["id"]) ); ?></th></tr>
					<tr><td class="noborder"><?php echo $project["Project"]["overview"]; ?></td><td></td></tr>
					
				</table>
				
			</div>
			<!--Project milesontes-->
			<div id="projectKeyMilestones">
			
				<?php if (count($project['Milestone']) != 0): ?>
					<table border="0" cellspacing="0" cellpadding="0" class="pleftside">
						<tr><th class="noborder">Key Milestones</th><th class="noborder"></th><th class="noborder"></th><th class="noborder"></th><th class="noborder"></th><th class="nobordercorner"><?php echo $html->link("Add Milestone" , array('controller' => 'milestones' , 'action' => 'add','master' => true , $project["Project"]["id"]) ); ?></th></tr>
						<tr>
							<th>Due Date</th>
							<th>Owner</th>
							<th>Description</th>
							<th>Status</th>
							<th>Completed</th>
							<th>Edit</th>
						</tr>
						<?php foreach($project['Milestone'] as $milestone):?>
					
							<?php if ($milestone['key'] == 1): ?>	
								<tr>
									<td><?php echo $timecal->format($milestone['enddate']); ?></td>
									<td width="200">
										<?php if (isset($milestone['User']['name'])): ?>
											<?php echo $milestone['User']['name']; ?>
										<?php else: ?>
											<?php echo $form->create("Milestone" , array('url'=>array('controller'=>'milestones' , 'action'=>'assign' , 'master'=>true, $milestone["id"] , $project["Project"]["id"]) ) ); ?>
									 			<select id="TaskUsersa" name="data[Milestone][usersa]">
									   			<option value="">Select one</option>
									  				<?php foreach($usersa as $option):?>
									  	 				<option value="<?php echo $option['id'] ?>"><?php echo $option['name'] ?></option>
									  				<?php endforeach;?>
									 			</select>
									 			<input type="submit" value="assign" class="submitassign"/> 
									 			</form>
										<?php endif; ?>
									</td>
									<td><?php echo $milestone['name']; ?></td>
									<td><?php echo $milestone['status']; ?></td>
									<td>
										<?php if ($milestone['completed'] != '0000-00-00'): ?>
											<?php echo $milestone['completed']; ?>
										<?php else: ?>
											<?php echo $html->link("complete" , array('controller' => 'milestones' , 'action' => 'complete','master'=>true, $milestone["id"] , $project["Project"]["id"]) ); ?>
										<?php endif; ?>
									</td>
									<td><?php echo $html->link("edit" , array('controller' => 'milestones' , 'action' => 'edit','master'=>true, $milestone["id"], $project["Project"]["id"]) ); ?></td>
								</tr>
						<?php endif; ?>
					
					<?php endforeach;?>
					<tr>
						<td></td><td></td><td></td><td></td><td></td>
						<th><?php echo $html->link('View All Milestones' , array('controller' => 'milestones' , 'action' => 'view', 'master'=>true , $project['Project']['id']) ); ?></th>
					</tr>
				</table>
			</div>
			<?php else: ?>
				<?php echo $html->link("Add Milestone" , array('controller' => 'milestones' , 'action' => 'add','master' => true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?>
			<?php endif; ?>
			
			
	
	</div>
	<!--Start of the right side Div-->
	<div id="projectRightSide">
			<!--Project Notices-->
			<div id="project_notices">
				<?php echo $html->link("Add Notice" , array('controller' => 'notices' , 'action' => 'add','master'=>true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?><br><br>
				<?php echo $html->link("View All" , array('controller' => 'notices' , 'action' => 'view','master'=>true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?>
				<br><br>
				
				<?php if (count($project["Notice"]) != 0 ): ?>
					<table border="0" cellspacing="0" cellpadding="0">
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
						<table border="0" cellspacing="0" cellpadding="0">
							<tr>
								<th class="noborder">Project Links</th><th class="noborder"></th><th class="nobordercorner"><?php echo $html->link("Add Link" , array('controller' => 'links' , 'action' => 'add','master'=>true, $project["Project"]["id"] ) ); ?></th>
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
								<td><?php echo $html->link("Delete" , array('controller' => 'links' , 'action' => 'delete','master'=>true , $link["id"] , $project["Project"]["id"]) ); ?> | <?php echo $html->link("Edit" , array('controller' => 'links' , 'action' => 'edit','master'=>true , $link["id"] , $project["Project"]["id"]) ); ?></td>
							</tr>
						<?php endforeach;?>	
						</table>
				<?php else: ?>
					<h3><?php echo $html->link("Add Link" , array('controller' => 'links' , 'action' => 'add','master'=>true, $project["Project"]["id"] ), array('class'=>'buttonlink') ); ?></h3>
				<?php endif; ?>	
			</div>
			<!--For updating project status-->
			<div id="projectStatus">
				<?php $countstats = count($project["Statuss"]); ?>
				<?php if ( $countstats == 0): ?>
					<?php echo $html->link("Change Project Status" , array('controller' => 'statusses' , 'action' => 'add','master'=>true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?>
				<?php else: ?>
				    <?php $statindice = $countstats - 1; ?>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr><th>Project Status</th><th><?php echo $html->link("Edit" , array('controller' => 'statusses' , 'action' => 'add','master'=>true , $project["Project"]["id"]) ); ?></th></tr>
						<tr>
							<td><?php echo $project["Statuss"][$statindice]['created'] ?></td>
							<td><?php echo $project["Statuss"][$statindice]['status'] ?></td>
						</tr>
						
					</table>
				<?php endif; ?>
			</div>
   
	</div>
	<!--Tasks of the project-->
	<div id="tasks_in_project">
				<?php if (count($project["Task"])): ?>
					<table border="0" cellspacing="0" cellpadding="0">
						<tr>
							<th>Id</th>
							<th>Task</th>
							<th>Priority</th>
							<th>Status</th>
							<th>User</th>
							<th>Actions</th>
						</tr>
					<?php foreach($tasks as $task):?>
			
						<tr>
							<td><?php echo $task["Task"]["id"]; ?></td>
							<td><?php echo $html->link($task["Task"]["name"] , array('controller' => 'tasks' , 'action' => 'view','master'=>true , $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
							<td><?php echo $priority->display($task["Task"]["priority"]); ?></td>
							<td><?php echo $task["Task"]["status"]; ?> %</td>
							<?php if ($task["Task"]["user_id"] == 0): ?>
							 <td>
								<?php echo $form->create("Task" , array('url'=>array('controller'=>'tasks' , 'action'=>'assign' , 'master'=>true, $task["Task"]["id"] , $project["Project"]["id"]) ) ); ?>
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
								<td><?php echo $task["Task"]["user_id"]; ?>
							<?php endif; ?>
							<td><?php echo $html->link("Delete task" , array('controller' => 'tasks' , 'action' => 'delete','master'=>true , $task["Task"]["id"] , $project["Project"]["id"]) ); ?></td>
						</tr>		
					<?php endforeach;?>
					</table>
					
					<?php echo $html->link("Add Another Task" , array('controller' => 'tasks' , 'action' => 'add','master'=>true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?><br><br>
					
				<?php else: ?>
		
					 <?php echo $html->link("Add A Task" , array('controller' => 'tasks' , 'action' => 'add','master'=>true , $project["Project"]["id"]), array('class'=>'buttonlink') ); ?> 
				<?php endif; ?>
	
	
	</div>	
	
</div>
	<!--Show users in the project-->
	<div id="users_in_project">
				<?php if (count($project["User"]) != 0): ?>
					<table border="0" cellspacing="0" cellpadding="0">
					<thead>
						<th>Users in the Project</th>
						<th>Actions</th>
					</thead>
					<?php foreach($project["User"] as $usr):?>
						<tr>
							<td><?php echo $html->link($usr["name"] , array('controller' => 'users' , 'action' => 'view','master'=>true , $usr["id"]) ); ?></td>
							<td><?php echo $html->link("Add Task" , array('controller' => 'tasks' , 'action' => 'add' , 'master'=>true ,$project["Project"]["id"] , $usr["id"]) ); ?> | <?php echo $html->link("View Tasks" , array('controller' => 'tasks' , 'action' => 'viewuser' , 'master'=>true, $usr["id"], $project["Project"]["id"]) ); ?> | <?php echo $html->link("Kick User" , array('controller' => 'users_projects' , 'action' => 'delete','master'=>true , $project["Project"]["id"] , $usr["id"]) ); ?>
						</tr>
					<?php endforeach;?>
					</table>
				<?php else: ?>
					No Users In the project please use the form below to add one.
				<?php endif; ?>
				
				<fieldset>
					<?php echo $form->create('UsersProject' , array('url'=>array('controller'=>'users_projects' , 'action'=>'add','master'=>true , $project["Project"]["id"]))); ?>
					<?php echo $form->input("user_id" , array('label'=>'Resource') ); ?>
					<input type="submit" value="Add User to Project"/>	
					</form>
				</fieldset>
	</div>
	<!--Budgeting information-->
	<div id="budgeting">
		<table border="0" cellspacing="0" cellpadding="0">
			
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
