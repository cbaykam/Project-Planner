<div id="pagetitle"><h1>Project Status</h1></div>
<div id="projectLeftSide">
<table style="width:500px;">
	<tr>
		<th>Date</th>
		<th>Status</th>
	</tr>
<?php foreach($data as $stats):?>
	<tr>
		<td><?php echo $stats["Statuss"]["created"]; ?></td>
		<td><?php echo $stats["Statuss"]["status"]; ?></td>
	</tr>	
<?php endforeach;?>
</table>
<?php echo $html->link("Return To Project" , array('controller' => 'projects' , 'action' => 'view' , $data[0]["Project"]["id"]) , array('class'=>'buttonlink') ); ?>
</div>