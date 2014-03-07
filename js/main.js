jQuery(document).ready( function($){
	$('#menu .dropdown-toggle').jwdropdown();
	$('#commentform').addClass('form-horizontal');
	
	control_group_html= '<div class="control-group btn-groups-submit">' + 
	'<div class="controls">' + 
	'</div>' +
	'</div>';
	
	$(control_group_html).appendTo($('#commentform'));
	$('.form-submit').appendTo('.btn-groups-submit .controls').find('#submit').addClass('btn');
})