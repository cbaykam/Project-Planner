<div id="pagetitle"><h1>Project Status</h1></div>
<div id="projectLeftSide">
<table style="width:500px;">
	<tr>
		<th>Date</th>
		<th>Status</th>
		<th>Actions</th>
	</tr>
<?php foreach($data as $stats):?>
	<tr>
		<td><?php echo $stats["Statuss"]["created"]; ?></td>
		<td><?php echo $stats["Statuss"]["status"]; ?></td>
		<td>
			<?php echo $html->link($html->image('ico_modify.gif') , array('controller'=>'statusses' , 'action'=>'edit' , 'master'=>true , $stats["Statuss"]["id"] , $data[0]["Project"]["id"]) , null , null , false )?>
			<?php echo $html->link($html->image('ico_delete.gif') , array('controller'=>'statusses' , 'action'=>'delete' , 'master'=>true , $stats["Statuss"]["id"] , $data[0]["Project"]["id"]) , null ,'Are you Sure you want to delete the Status ?' , false )?>
		</td>
	</tr>	
<?php endforeach;?>
</table>
<?php echo $html->link("Return To Project" , array('controller' => 'projects' , 'action' => 'view','master'=>true , $data[0]["Project"]["id"]) , array('class'=>'buttonlink') ); ?>
</div>