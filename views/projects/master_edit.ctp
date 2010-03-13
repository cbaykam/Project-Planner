<div id="pagetitle"><h1><?php __('Edit Project');?></h1></div>
<?php echo $javascript->link('jquery-1.3.2.min' , false); ?>
<?php echo $javascript->link('milestones' , false); ?>
<div id="projectLeftSide">
<?php echo $form->create('Project' , array('url'=>array('controller'=>'projects' , 'action'=>'edit' , 'master'=>true , $this->params["pass"][1])));?>
	<fieldset>
	<div class="input select">
	<label for="ProjectCustomer">Customer</label>
	<select id="ProjectCustomer" name="data[Project][customer]">
 	<?php foreach($customerdata as $customer):?>
 		<?php if($this->data["Project"]["customer"] != $customer["User"]["name"]):?>
			<option value="<?php echo $customer["User"]["name"]?>"><?php echo $customer["User"]["name"]?></option>
 		<?php else:?>
 			<option value="<?php echo $customer["User"]["name"]?>" selected="true"><?php echo $customer["User"]["name"]?></option>
 		<?php endif;?>
 	<?php endforeach;?>
 	</select>
 	</div>
	<?php
		echo $form->input('name' , array('label'=>'Project Name'));
		echo $form->input('overview' , array('type'=>'textfield') );
		echo $form->input('user_id' , array('label'=>'Project Manager'));
		echo $form->input('redalto' , array('label'=>'Project Type' , 'type'=>'select' , 'options'=>array('0'=>'Customer' , '1'=>'Redalto') ) );
		echo $form->input('duedate' , array('label'=>'Due Date', 'dateFormat'=>'DMY' , 'minYear'=>'2010' , 'maxYear'=>'2015'));
	?>
	<br>
		<span class="duration">
			Budget 
		</span>
	    	<input id="ProjectName" type="text" value="<?php echo $budget?>" maxlength="128" name="data[Project][hours]" size="4"/>	
				Hrs
			<input id="ProjectName" type="hidden" value="0" size="4"/>
	</fieldset>
<input type="submit" value="Submit">
</div>
<div id="projectRightSide">
	
	</form>
	<?php if(count($this->data["Milestone"])!=0):?>
		<table>
  


		<?php foreach ($this->data['Milestone'] as $miles):?>
				<tr>
				    <td>Milestone Name</td>
				    <td><?php echo $miles["name"]?></td>
			    </tr>
			    <tr>
				    <td style="border-bottom:1px solid;">Milestone Due Date</td>
				    <td style="border-bottom:1px solid;"><?php echo $timecal->format($miles["enddate"])?></td>
			    </tr>
		<?php endforeach;?>
		</table>
	<?php else:?>
		This project has no Milestones
	<?php endif;?>
</div>