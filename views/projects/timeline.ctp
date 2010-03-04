<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>
<div id="projectLeftSide">
<div align="right" style="width:95%;">
</div>
<h3> Customer Projects </h3>
	<div align="center" class="forwardback">
	<a href="#" class="GNT_prev3"><?php echo $html->image("fbackward.gif")?></a> 
	<a href="#" class="GNT_prev4"><?php echo $html->image("backward.gif")?></a> 
	<a href="#" class="GNT_now3"><span id="nowsq">Now</b></span> 
	<a href="#" class="GNT_next4"><?php echo $html->image("forward.gif")?></a> 
	<a href="#" class="GNT_next3"><?php echo $html->image("fforward.gif")?></a> 
	</div>
	<br><br>

<div class="gantt" id="gantt2"></div> 
<br><br>
<div align="right" style="width:95%;">
</div>
<h3> Redalto Projects </h3>
	<div align="center" class="forwardback">
	<a href="#" class="GNT_prev"><?php echo $html->image("fbackward.gif")?></a> 
	<a href="#" class="GNT_prev2"><?php echo $html->image("backward.gif")?></a> 
	<a href="#" class="GNT_now"><span id="nowsq">Now</b></span> 
	<a href="#" class="GNT_next2"><?php echo $html->image("forward.gif")?></a> 
	<a href="#" class="GNT_next"><?php echo $html->image("fforward.gif")?></a> 
	</div>
	<br><br>

	<div class="gantt" id="gantt"></div> 
	

</div> 

<div id="projectRightSide">
<table>
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

</div>