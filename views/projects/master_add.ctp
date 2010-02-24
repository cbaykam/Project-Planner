<div id="pagetitle"><h1><?php __('Add Project');?></h1></div>
<?php echo $javascript->link('jquery-1.3.2.min' , false); ?>
<?php echo $javascript->link('milestones' , false); ?>
<div id="projectLeftSide">
<?php echo $form->create('Project');?>
	<fieldset>
	<div class="input select">
	<label for="ProjectCustomer">Customer</label>
	<select id="ProjectCustomer" name="data[Project][customer]">
 	<?php foreach($customerdata as $customer):?>
		<option value="<?php echo $customer["User"]["name"]?>"><?php echo $customer["User"]["name"]?></option>
 	<?php endforeach;?>
 	</select>
 	</div>
	<?php
		echo $form->input('name' , array('label'=>'Project Name'));
		echo $form->input('overview' , array('type'=>'textfield') );
		echo $form->input('user_id' , array('label'=>'Project Manager'));
		echo $form->input('redalto' , array('label'=>'Project Type' , 'type'=>'select' , 'options'=>array('0'=>'Customer' , '1'=>'Redalto') ) );
		echo $form->input('duedate' , array('label'=>'Due Date', 'dateFormat'=>'DMY'));
	?>
	<br>
		<span class="duration">
			Budget 
		</span>
	    	<input id="ProjectName" type="text" value="" maxlength="128" name="data[Project][hours]" size="4"/>	
				Hrs
			<input id="ProjectName" type="hidden" value="0" size="4"/>
	</fieldset>
<input type="submit" value="Submit">
</div>
<div id="projectRightSide">
	<?php echo $this->element('milestones'); ?>
	</form>
</div>