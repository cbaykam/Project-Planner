function removefields(){
	var html = '<a href="#" id="addMilestones">Add Standart Milestones</a>';
	$("#milestones").replaceWith(html);
}


$(document).ready(function(){ 
	$('#removeMilestones').click(function(event){	
		event.preventDefault();
		removefields();
	})
});
