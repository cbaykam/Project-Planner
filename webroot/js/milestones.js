function addfields(){
	
	var html = "<a href='#' id='removeMilestones'>Remove Milestones</a>"; 
	var loadUrl = baseUrl + 'master/milestones/standart';
	var obj = $(html).click(function(){
		removefields();
		event.preventDefault();
	});
	$("#milestones").empty().append(obj);
	$("#milestones").load(loadUrl);
	
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
