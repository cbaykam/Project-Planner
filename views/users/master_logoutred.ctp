<div id="pagetitle"><h1>Logged Out</h1></div>
<div id="projectLeftSide">
You have successfully logged out from administration console. What would you like to do?
	<ul>
		<li><?php echo $html->link('Log back into the Project Planner', array('controller'=>'users' , 'action'=>'login'))?></li>
		<li><a href="javascript:window.opener='x';window.close();">Close the browser</a></li>
	</ul>
</div>