<div id="pagetitle"><h1><?php __('Add Note/Activity');?> </h1></div>
<div id="projectLeftSide">
<?php echo $form->create('Activity' , array( 'type'=>'file' , 'url'=>array('controller'=>'activities' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0] , $projectid , $this->params["pass"][2]) ) );?>
	<fieldset>
	<label for="taskName">Task </label>
	<span id="taskName"><b><?php echo $tdata["Task"]["name"]?></b></span>
	<br><br>
	<label for="taskName">Task Id</label>
	<span id="taskName"><?php echo $tdata["Task"]["id"]?></span>
	<br><br>
	<?php
		echo $form->input('description' , array('type'=>'textfield' , 'label'=>'Add a note or description of activity that has been done' , 'rows'=>'10' , 'cols'=>'45' ) );
		echo $form->input('date');
	?>
		<label for="ActivityHour">Time Taken</label>
	    	<select name="data[Activity][hour]" class="durhr" id="ActivityHour">
				<option value="0">00</option>
				<option value="1">01</option>
				<option value="2">02</option>
				<option value="3">03</option>
				<option value="4">04</option>
				<option value="5">05</option>
				<option value="6">06</option>
				<option value="7">07</option>
				<option value="8">08</option>
				<option value="9">09</option>
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
				<option value="23">23</option>
				<option value="24">24</option>
				</select>	
				Hrs
				<select name="data[Activity][minute]" id="ActivityMinute">
				<option value="0">00</option>
				<option value="5">05</option>
				<option value="10">10</option>
				<option value="15">15</option>
				<option value="20">20</option>
				<option value="25">25</option>
				<option value="30">30</option>
				<option value="35">35</option>
				<option value="40">40</option>
				<option value="45">45</option>
				<option value="50">50</option>
				<option value="55">55</option>
			</select>
			Mins
			<br><br>
			<?php echo $form->input('file', array('type'=>'file')); ?> 	
			<label for="taskName">User</label>
			<select id="ActivityUser" name="data[Activity][user_id]">
			<?php foreach($users as $uss):?>
				<option value="<?php echo $uss["id"]?>" <?php if($uss["id"] == $usss):?>SELECTED<?php endif;?>><?php echo $uss["name"]?></option>
			<?php endforeach;?>
			</select>
	</fieldset>
	<input type="submit" value="Submit"> <?php echo $html->link('Cancel' , array('controller'=>'tasks' , 'action'=>'view' , 'master'=>true , $this->params["pass"][0]));?>
	</form>
	<br>
	
	</div>
	

