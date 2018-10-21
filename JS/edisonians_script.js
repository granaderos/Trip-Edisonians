$(document).ready(function(){

	$("#continue").click(function(){
		var edisonians_code = "sir_gibs";
		var firstname = $("#firstname").val();
		var middlename = $("#middlename").val();
		var lastname = $("#lastname").val();
		var gender = $("#gender").val();
		var age = $("#age").val();
		var birthdate = $("#month").val() + " " + $("#day").val() + " " + $("#year").val();
		var address = $("#address").val();
		var new_username = $("#new_username").val();
		var new_password = $("#new_password").val();
		var retyped_password = $("#retyped_password").val();
	
		var string_pattern = /^[a-z, A-Z]*$/;
		var integer_pattern = /^[0-9]*$/;
		var both_pattern = /^[a-z, A-Z, 0-9]$/;
		
		var valid_firstname = string_pattern.test(firstname);
		var valid_middlename = string_pattern.test(middlename);
		var valid_lastname = string_pattern.test(lastname);
		var valid_age = integer_pattern.test(age);
		var valid_username = string_pattern.test(new_username);
		
		if(firstname != "" && valid_firstname && middlename != "" && valid_middlename && lastname != "" && valid_lastname && age != "" && valid_age && address != "" && new_username != "" && valid_username && new_password != "" && new_password == retyped_password) {
			if($("#code_entered").val() == edisonians_code) {
				$.ajax({
					type: "POST",
					url: "PHP/OBJECTS/USERS/add_user.php",
					data: {data: JSON.stringify($("#registration_form").serializeArray())},
					success: function(data) {
                        alert('aehm = ' + data);
						$("#username_span").html(new_username);
						$("#register_confirmation").dialog({
							show: "drop",
							hide: "drop",
							modal: true,
							buttons: {
								"OKAY": function(){
									$(this).dialog("close");
								}
							}
							
						});
					},
					error: function(data) {
                        alert('aehm error = ' + JSON.stringify(data));
						console.log("error in adding users = " + JSON.stringify(data));
					}
				});
			
			} else {
				$("#invalid_code").show();
				$("#invalid_code").fadeOut(7000);
			}
		} else {
			$("#register_invalid_warning").show();
			$("#register_invalid_warning").fadeOut(7000);
		}
	});
	
	//``````` determine current user ``````````````
	
	$.ajax({
		url: "PHP/OBJECTS/USERS/determine_current_user.php",
		success: function(data) {
			console.log(data);
			var parsed_data = JSON.parse(data);
			$("#current_user_id").val(parsed_data.current_user_id);
			$("#current_user_fullname").val(parsed_data.current_user_fullname);
			$("#user_fullname_span").html(parsed_data.current_user_fullname);
			
			display_contacts();
			display_birthdays();
			display_messages();
			display_online_users();
			display_quotes();
			display_private_messages();
			display_sent_messages();
			get_current_time();
		},
		error: function(data) {
			console.log("error in determining current user = " + JSON.stringify(data));
		}
	});
	
	//------------- contacts ------------
	
	
	
	$("#add_contact_button").click(function(){
		$.ajax({
			type: "POST",
			url: "PHP/CONTACTS/check_contact_owner.php",
			data: {"current_user_fullname": $("#current_user_fullname").val()},
			success: function(data) {
				if(data == "true") {
					$("#continue_adding_confirmation").dialog({
						show: "fadeIn",
						hide: "fadeOut",
						modal: true,
						width: 600,
						draggable: false,
						buttons: {
							"yes": function() {
								$("#add_contact_div").dialog({
									show: "drop",
									hide: "fold",
									modal: true,
									width: 500,
									draggable: false,
									buttons: {
										"cancel": function() {
											$(this).dialog("close");
										}
									}
								});
								$(this).dialog("close");
							},
							"no": function() {
								$(this).dialog("close");
							},
							"cancel": function() {
								$(this).dialog("close");
							}
						}
					});
				} else {
					$("#add_contact_div").dialog({
						show: "drop",
						hide: "fold",
						modal: true,
						width: 500,
						draggable: false,
						buttons: {
							"cancel": function() {
								$(this).dialog("close");
							}
						}
					});
				}
			},
			error: function(data) {
				console.log("error in checking contact owner = " + JSON.stringify(data));
			}
		});
	});
	
	$("#dipslay_contacts_button").click(function(){
		var int_pattern = /^[0-9]*$/;
		var contact_number = $("#contact_number").val();
		var contact_valid = int_pattern.test(contact_number);
		if(contact_number != "" && contact_valid && contact_number.length == 11) {
			if($("#contact_network").val() != "Select Network" ) {
		
				$.ajax({
					type: "POST",
					url: "PHP/CONTACTS/adding_contacts.php",
					data: {"contact_number": $("#contact_number").val(), "contact_network": $("#contact_network").val(), "current_user_fullname": $("#current_user_fullname").val()},
					success: function(data) {
						if(data == "You already displayed that contact number!") {
							$("#already_displayed").show();
							$("#already_displayed").fadeOut(7000);
						} else {
							if(data == "The contact number you've entered already exists!") {
								$("#contact_exists").show();
								$("#contact_exists").fadeOut(7000);
							} else {
								$("#display_contacts_table").append(data);
								$("#add_contact_div").dialog("close");
								$("#displaying_confirmation").dialog({
									show: "drop",
									hide: "drop",
									modal: true,
									draggable: false,
									buttons: {
										"okay": function(){
											$(this).dialog("close");
										}
									}
								});
							}
						}
					},
					error: function(data) {
						console.log("error in adding contacts = " + JSON.stringify(data));
					}
				});
			} else {
				$("#select_network_warning").show();
				$("#select_network_warning").fadeOut(7000);
			}
		} else {
			$("#empty_contact_field_warning").show();
			$("#empty_contact_field_warning").fadeOut(7000);
		}
		
	});
	
	$("#save_contacts_button").click(function(){
		var int_pattern = /^[0-9]*$/;
		var contact_number = $("#new_contact_number").val();
		var contact_valid = int_pattern.test(contact_number);
		if(contact_number != "" && contact_valid && contact_number.length == 11){
			if($("#new_contact_network").val() != "Select Network") {
				$.ajax({
					type: "POST",
					url: "PHP/CONTACTS/edit_contact.php",
					data: {"id": $("#id").val(), "new_contact_number": $("#new_contact_number").val(), "new_contact_network": $("#new_contact_network").val(), "current_user_fullname": $("#current_user_fullname").val()},
					success: function(data) {
						if(data == "You already displayed that contact number!") {
							$("#already_displayed2").show();
							$("#already_displayed2").fadeOut(7000);
						} else {
							if(data == "The contact number you've entered already exists!") {
								$("#contact_exists2").show();
								$("#contact_exists2").fadeOut(7000);
							} else {
								var id = $("#id").val();
								$(document.getElementById(id)).html(data);
								$("#save_contact_confirmation").show();
								$("#save_contact_confirmation").fadeOut(5000);
								$("#edit_contact_div").fadeOut(5000);
							}
						}
					},
					error: function(data) {
						console.log("error in editing contacts = " + JSON.stringify(data));
					}
				});
			} else {
				$("#select_network_warning2").show();
				$("#select_network_warning2").fadeOut(7000);
			}
		} else {
			$("#empty_contact_field_warning2").show();
			$("#empty_contact_field_warning2").fadeOut(7000);
		}
	});

    $("#display_quotes_button").click(function(){
        if($("#quotes_to_add").val() != "") {
            get_current_time();
            $.ajax({
                type: "POST",
                url: "PHP/OBJECTS/QUOTES/adding_quotes.php",
                data: {"current_user_fullname": $("#current_user_fullname").val(), "quotes_to_add": $("#quotes_to_add").val(), "current_time": $("#current_time").val()},
                success: function(data){
                    $("#added_quotes_div").prepend(data);
                },
                error: function(data){
                    console.log("error in adding quotes" + JSON.stringify(data));
                }
            });

        } else {
            $("#empty_quotes_warning").show();
            $("#empty_quotes_warning").fadeOut(7000);
        }
    });

//```````````````` message center ````````````````````

    $("#send_message_button").click(function(){
        if($("#message_field").val() != "") {
            $.ajax({
                type: "POST",
                url: "PHP/OBJECTS/MESSAGE_CENTER/add_message.php",
                data: {"current_user_fullname": $("#current_user_fullname").val(), "message_field": $("#message_field").val()},
                success: function(data){
                    $("#message_center_area ").append(data);
                },
                error: function(data) {
                    console.log("error in adding message = " + JSON.stringify(data));
                }
            });
        }
    });

    $("#message_form").submit(function(){
        if($("#message_field").val() != "") {
            $.ajax({
                type: "POST",
                url: "PHP/OBJECTS/MESSAGE_CENTER/add_message.php",
                data: {"current_user_fullname": $("#current_user_fullname").val(), "message_field": $("#message_field").val()},
                success: function(data){
                    $("#message_center_area ").append(data);
                    $("#message_field").val("")
                },
                error: function(data) {
                    console.log("error in adding message = " + JSON.stringify(data));
                }
            });
        }
        return false;
    });

});

	
	//``````````````````````` for quotes `````````````````
	
function display_quotes(){
    $.ajax({
        url: "PHP/OBJECTS/QUOTES/displaying_quotes.php",
        success: function(data){
            $("#added_quotes_div").html(data);
        },
        error: function(data){
            alert("error in dis = " + JSON.stringify(data));
            console.log("error in displaying quotes" + JSON.stringify(data));
        }
    });
    setTimeout(display_quotes, 1000);
}

function display_contacts() {
	$.ajax({
		type: "POST",
		url: "PHP/CONTACTS/displaying_contacts.php",
		data: {"current_user_fullname": $("#current_user_fullname").val()},
		success: function(data) {
			$("#display_contacts_table").html(data);
		},
		error: function(data) {
			console.log("error in displaying contacts = " + JOSN.stringify(data));
		}
	});
	
	setTimeout(display_contacts, 1000);
}

function execute_action(id) {
	$("#contact_actions").dialog({
		show: "size",
		hide: "size",
		modal: true,
		width: 700,
		draggable: false,
		buttons: {
			"edit contact": function() {
				$("#edit_contact_div").show();
				$.ajax({
					type: "POST",
					url: "PHP/CONTACTS/retrieving_contact.php",
					data: {"id": id},
					success: function(data) {
						var parsed_data = JSON.parse(data);
						$("#new_contact_number").val(parsed_data.contact_number);
						$("#new_contact_network").val(parsed_data.contact_network);
						$("#id").val(parsed_data.contact_id);
					},
					error: function(data) {
						console.log("error in retrieving contactss!");
					} 
				});
			},
			
			"delete contact": function() {
				$("#contact_actions").dialog("close");
				$("#delete_confirmation").dialog({
					show: "bounce",
					hide: "explode",
					modal: true,
					width: 400,
					draggable: false,
					buttons: {
						"YES": function() {
							$.ajax({
								type: "POST",
								url: "PHP/CONTACTS/delete_contact.php",
								data: {"id": id},
								success: function() {
									$(document.getElementById(id)).remove();
								},
								error: function(data) {
									console.log("error in deleting contact = " + JSON.stringify(data));
								}
					
							}).done(function(){
								$("#delete_confirmation").dialog("close");
							})
						},
						"NO": function() {
							$(this).dialog("close");
						}
					}
				});
				
			},
			
			"close": function() {
				$(this).dialog("close");
			}
		}
	});
}

function display_birthdays() {
	$.ajax({
		url: "PHP/BIRTHDAYS/displaying_birthdays.php",
		success: function(data) {
			var parsed_data = JSON.parse(data);
			$("#january_birthdays").html(parsed_data.january_birthdays);
			$("#february_birthdays").html(parsed_data.february_birthdays);
			$("#march_birthdays").html(parsed_data.march_birthdays);
			$("#april_birthdays").html(parsed_data.april_birthdays);
			$("#may_birthdays").html(parsed_data.may_birthdays);
			$("#june_birthdays").html(parsed_data.june_birthdays);
			$("#july_birthdays").html(parsed_data.july_birthdays);
			$("#august_birthdays").html(parsed_data.august_birthdays);
			$("#march_birthdays").html(parsed_data.september_birthdays);
			$("#october_birthdays").html(parsed_data.october_birthdays);
			$("#november_birthdays").html(parsed_data.november_birthdays);
			$("#december_birthdays").html(parsed_data.december_birthdays);
		},
		error: function(data) {
			console.log("error in dipslaying birthdays = " + JSON.strngify(data));
		} 
	});
	
	setTimeout(display_birthdays, 1000);
}

function display_messages() {
	$.ajax({
		url: "PHP/OBJECTS/MESSAGE_CENTER/display_messages.php",
		success: function(data) {
			if(data == "") {
				$("#message_center_area").html("No messages.");
			}else {
				$("#message_center_area").html(data);
			}
		},
		error: function(data) {
			console.log("error in displaying messages = " + JSON.stringify(data));
		}
		
	});
	
	setTimeout(display_messages, 1000);
}

function display_online_users() {
	$.ajax({
		type: "POST",
		url: "PHP/USERS/get_online_users.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			$("#online_users_table").html(data);
		},
		error: function(data) {
			console.log("error in displaying on line users = " + JSON.stringify(data));
		}
	});
	
	setTimeout(display_online_users, 1000);
}

function send_private_message(id) {
	
	$.ajax({
		type: "POST",
		url: "PHP/MESSAGE_CENTER/getting_recipient.php",
		data: {"id": id},
		success: function(data) {
			$("#send_to_span").html(data);
			$("#send_private_message_div").show();
			$("#send_private_message_button").click(function(){
			var private_message = $("#private_message_field").val();
			if(private_message != ""){
				$.ajax({
					type: "POST",
					url: "PHP/MESSAGE_CENTER/add_private_message.php",
					data: {"current_user_fullname": $("#current_user_fullname").val(), "id": id, "private_message_field": $("#private_message_field").val(), "current_time": $("#current_time").val()},
					success: function(data) {
						$("#send_private_message_div").hide();
					},
					error: function(data) {
						console.log("error in adding private message = " + JSON.stringify(data));
					}
				});
			}
		});
		},
		error: function(data) {
			console.log("error in getting recipient = " + JSON.stringify(data));
		}
	});
}

function display_private_messages() {
	$.ajax({
		type: "POST",
		url: "PHP/MESSAGE_CENTER/display_private_messages.php",
		data: {"current_user_id": $("#current_user_id").val()},
		success: function(data) {
			if(data == ""){
					$("#received_messages_append").html("No messages from everyone! :P");
			} else{
				$("#received_messages_append").html(data);
			}
		},
		error: function(data) {
			console.log("error in displaying private message = " + JSON.stringify(data));
		}
	});
	
	setTimeout(display_private_messages, 1000);
}

function display_sent_messages() {
	$.ajax({
		type: "POST",
		url: "PHP/MESSAGE_CENTER/display_sent_messages.php",
		data: {"current_user_fullname": $("#current_user_fullname").val()},
		success: function(data) {
			if(data == "") {
				$("#sent_messages_append").html("Empty sent items.");
			} else {
				$("#sent_messages_append").html(data);
			}
		},
		error: function(data) {
			console.log("error in displaying sent messages = " + JSON.stringify(data));
		}
	});
	
	setTimeout(display_sent_messages, 1000);
}

function delete_received_private_message(id) {
   $.ajax({
      type: "POST",
      url: "PHP/MESSAGE_CENTER/delete_received_private_message.php",
      data: {"id": id},
      success: function() {
         $(document.getElementById('received_private_message_' + id)).remove();
      },
      error: function(data) {
         console.log("error in deleting private_message = " + JSON.stringify(data));
      }
      
   });
}

function delete_sent_private_message(id) {
	$.ajax({
		type: "POST",
		url: "PHP/MESSAGE_CENTER/delete_sent_private_message.php",
		data: {"id": id},
		success: function() {
			$(document.getElementById('sent_private_message_' + id)).remove();
		},
		error: function(data) {
			console.log("error in deleting sent private message = " + JSON.stringify(data));
		}
	});
}

	
	


/*
	//++++++++++++++++++++++++++++++++++++++++++++++++++
	$("#saveEditedQuotes").click(function(){
		
		var dataObject = { "id": $("input[name='id']").val(),
								 "quotes": $("#ta").val()
								};

		var dataArray = $("#formQuotesId").serializeArray();
		var id = dataArray[1].value;
		var dataStringified = JSON.stringify(dataArray);
		$.ajax({
			type: "POST",
			url: "gettingQuotesToSave.php",
			data: dataObject,
			success: function(){
				$(document.getElementById(dataObject.id)).html(data);
			},
			error: function(){
				console.log("there's an error in saving quotes!" + data);
			}
		});
	});

});

	function deleteQuotes(id){
		var idObject = { "id" : id };
		$.ajax({
			type: "POST",
			url: "gettingQuotesToDelete.php",
			data: idObject,
			success: function(data){
				
				$(document.getElementById(id)).remove();
			},
			error: function(){
				console.log("there's an error im deleting!" + data);
			}
		});
		setTimeout('delete',1000)
	}

//++++++++++++++++++++++++++++++++++++++++++++++++++++++++
	function editQuotes(id){
		var idObject = { "id" : id };
		$.ajax({
			type: "POST",
			url: "gettingQuotesToEdit.php",
			data: idObject,
			success: function(data){
				var object = JSON.parse(data);
				$("#ta").val(object.quotes);
			},
			error: function(data){
				console.log("there's an error!" + data);
			}
		});
	}
*/

function get_current_time() {
	
	var time = new Date();
	var month = time.getMonth();
	var day = time.getDate();
	var year = time.getFullYear();
	var hour = time.getHours();
	var minute = time.getMinutes();
	var second = time.getSeconds();
	var extension = "AM";

	var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
	var month_counter = 0;
	
	while(month_counter < 12) {
		if(month == month_counter) {
			month = months[month_counter];
		}
		month_counter++;
	}
	
	if(hour >= 12) {
		hour = hour - 12;
		extension = "PM";
	}
	
	if(hour == 0) {
		hour = 12;
	}
	
	if(minute < 10) {
		minute = "0" + minute;
	}
	
	$("#current_time").val(month + " " + day + ", " + year + " " + hour + ":" + minute + " " + extension);
}
