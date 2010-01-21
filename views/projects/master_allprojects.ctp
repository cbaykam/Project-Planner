<?php echo $html->css('jquery.gantt' , 'stylesheet' , array() , false); ?>
<?php echo $javascript->link('jquery-1.3.2' , false); ?>
<?php echo $javascript->link('jquery.gantt' , false); ?>

<table style="width:250px;">
  <tr>
    <td></td>
    <th>Standard Project Milestones</th>
  </tr>
  <tr>
    <td>Phase 1</td>
    <td style="background:#d7e4bd;">Consult (Assess & Specify)</td>
  </tr>
  <tr>
    <td>Phase 2</td>
    <td style="background:#fcd5b5;">Design (Graphic Design)</td>
  </tr>
  <tr>
    <td>Phase 3</td>
    <td style="background:#b9cde5;">Build (Web Development)</td>
  </tr>
  <tr>
    <td>Phase 4</td>
    <td style="background:#ffff99;">Test (ORT)</td>
  </tr>
  <tr>
    <td>Phase 5</td>
    <td style="background:#ff99ff;">Launch (UAT & Client Handover)</td>
  </tr>
</table>

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