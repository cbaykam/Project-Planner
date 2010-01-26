<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<?php echo $html->link(__('Add Resource', true), array('controller'=>'users' , 'action'=>'add','master'=>true) , array('class'=>'buttonlink')); ?>
<h3>Resourcing</h3>

	 <div id="vacationcolor">Holiday / Vacation</div>
	 <div id="othercolor">unavailable (other reason)</div>
	 
	 <a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 