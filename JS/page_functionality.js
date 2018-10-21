$(document).ready(function(){

	$("#tabs_menu").tabs();
	$("#add_contact_div").hide();
	$('#delete').hide();
	$('#edit').hide();
	$('#duringYearEnd').hide();
	$("#displaying_confirmation").hide();
	$("#continue_adding_confirmation").hide();
	$(".warning").hide();
	$("#contact_actions").hide();
	$("#edit_contact_div").hide();
	$(".confirmation_dialog").hide();
	$("#send_private_message_div").hide();
	$("#received_private_messages_div").hide();
	$("#sent_private_messages_div").hide();
	$("#new_private_messages_div").hide();
	$("#add_event_div").hide();

	$("#send_cancel_button").click(function(){
		$("#send_private_message_div").hide();
	});

	$("#received_messages_span").click(function(){
		$("#received_private_messages_div").fadeIn(900);
	});
	
	$("#sent_messages_span").click(function(){
		$("#sent_private_messages_div").fadeIn(900);
	});
	
	$("#exit_received_private_messages_div").click(function(){
		$("#received_private_messages_div").fadeOut(2000);
	});
	
	$("#exit_sent_private_messages_div").click(function(){
		$("#sent_private_messages_div").fadeOut(2000);
	});

	$("#add_events_button").click(function(){
		$("#add_event_div").show();
	});


	var body_height = $(document).height();
	
	$("#send_private_message_div").height(body_height).css({"padding": 90, 'opacity' : 0.9, 'position': 'fixed', 'top': 0, 'left': 0, 'background-color': 'white', 'width': '100%', 'z-index': 5000 });
   
/*	
function time(){

var times = new Date();
document.getElementById('time_string').innerHTML=times.getSeconds();
setTimeout(time,1000);
}
time();
*/
});
 
// +++++++++++++++++++++++++++++++++++++++++++++++//

	


