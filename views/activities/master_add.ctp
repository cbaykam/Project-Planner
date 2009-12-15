<div class="activities form">
<?php echo $form->create('Activity' , array('url'=>array('controller'=>'activities' , 'action'=>'add' , 'master'=>true , $this->params["pass"][0] , $this->params["pass"][1]) ) );?>
	<fieldset>
 		<legend><?php __('Add Activity');?></legend>
 		
 	<b>Duration (Hour : Minute)</b> <input id="ActivityHour" type="text" value="" maxlength="3" name="data[Activity][hour]" size="3" /> <b>:</b>
 	<input id="ActivityMinute" type="text" value="" maxlength="2" name="data[Activity][minute]" size="3" /> 
	<?php
		echo $form->input('description' , array('type'=>'text') );
		echo $form->input('date');
	?>
		<select id="ActivityUserId" name="data[Activity][user_id]">
			<?php foreach($users as $usr):?>
		
				<option value="<?php echo $usr['id'];?>"><?php echo $usr["name"]; ?></option>
		
		<?php endforeach;?>
				
					
				
		</select>
	</fieldset>
<?php echo $form->end('Submit');?>
</div>
