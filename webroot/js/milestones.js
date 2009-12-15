function addfields(){
	
	var html = "<a href='#' id='removeMilestones'>Remove Milestones</a>"; 
	var content = "<table><tr><th>Milestone</th><th>Due Date</th></tr><tr><td><input type='text' name='data[Milestone][0][name]' value='Consult (Assess & Specify)' size='50'></td><td></td></tr>";
	var obj = $(html).click(function(){
		removefields();
		event.preventDefault();
	});
	$("#milestones").empty().append(obj);
	$("#milestones").load('http://localhost/planner/master/milestones/standart');
	
}

function removefields(){
	var obj = $('<a href="#" id="addMilestones">Add Standard Milestones</a>');
	obj.click(function(){
		addfields();
		event.preventDefault();
	});
	$("#milestones").empty().append(obj);
	}

$(document).ready(function(){ 
	removefields();
});
