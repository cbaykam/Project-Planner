<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>

<?php echo $html->link("Add a Project" , array('controller' => 'projects' , 'action' => 'add','master'=>true) , array('class'=>'buttonlink') ); ?><br><br>


<table style="width:250px;">
  <tr>
    <td></td>
    <th>Standard Project Milestones</th>
  </tr>
  <?php $i = 1;?>
  <?php foreach ($stmileston as $stmls):?>
  	<tr>
	    <td>Phase <?php echo $i;?></td>
	    <?php $i++;?>
	    <td style="background:<?php echo $stmls["Standart"]["color"]?>;"><?php echo $stmls["Standart"]["name"]?></td>
  	</tr>
  <?php endforeach;?>
</table>
<br><br>

<h3> Redalto Projects </h3>

	<a href="#" class="GNT_prev">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev2">[&lt;]</a> 
	<a href="#" class="GNT_now">now</a> 
	<a href="#" class="GNT_next2">[&gt;]</a> 
	<a href="#" class="GNT_next">[&gt;&gt;]</a> 
	<br><br>

	<div class="gantt" id="gantt"></div> 
	<br><br><br>
<h3> Customer Projects </h3>

	<a href="#" class="GNT_prev3">[&lt;&lt;]</a> 
	<a href="#" class="GNT_prev4">[&lt;]</a> 
	<a href="#" class="GNT_now3">now</a> 
	<a href="#" class="GNT_next4">[&gt;]</a> 
	<a href="#" class="GNT_next3">[&gt;&gt;]</a> 
	<br><br>

<div class="gantt" id="gantt2"></div> 
