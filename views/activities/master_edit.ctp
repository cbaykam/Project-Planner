<div class="activities form">
<?php echo $form->create('Activity' , array('url'=>array('controller'=>'activities' , 'action'=>'edit' , 'master'=>true , $this->params["pass"][1] , $this->params["pass"][2])) );?>
	<fieldset>
 		<legend><?php __('Edit Activity');?></legend>
	<?php
		echo $form->input('id');
	?>
	<b>Duration (Hour : Minute)</b> <input id="ActivityHour" type="text" value="<?php echo $timecal->hour($this->data['Activity']['duration']);?>" maxlength="3" name="data[Activity][hour]" size="3" /> <b>:</b>
 	<input id="ActivityMinute" type="text" value="<?php echo $timecal->minute($this->data['Activity']['duration']);?>" maxlength="2" name="data[Activity][minute]" size="3" /> 
	<?php
		echo $form->input('description');
	?>
	<select id="ActivityUserId" name="data[Activity][user_id]">
			<?php foreach($users as $usr):?>
		
				<option value="<?php echo $usr['id'];?>"><?php echo $usr["name"]; ?></option>
		
		<?php endforeach;?>
				
					
				
		</select>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
