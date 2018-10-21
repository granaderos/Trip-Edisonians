<?php
	session_start();
	
	if(!isset($_SESSION['username_entered'])) {
		header("Location: edisonians_log_in.php");
	}
?>
<!Doctype html>
<html>
	<head>
	  <title>edisonians!</title>
		<script src="JS/jquery-1.8.2.min.js"></script>
		<script src = "JS/jquery-ui-1.9.0.custom.min.js"></script>
		<script src="JS/edisonians_script.js"></script>
		<script src="JS/page_functionality.js"></script>
		<link rel = "stylesheet" href = "CSS/jquery-ui-1.9.0.custom.min.css" />
		<link rel = "stylesheet" href="CSS/edisonians.css" />
		<link rel = "shortcut icon" href = "CSS/images/t.jpeg" />
	</head>
	<body id="home_body">
		<div id = "container">
			<h1 id="ourWorld"><span>EDISONIANS' </span>WORLD</h1><div id="time_string"></div>
			<div id = "user_div">
				<span id = "user_fullname_span"></span>
				<a href = "edisonians_log_out.php" id = "deactivate_account_a">deactivate account</a>
			</div>
			
			<div id = "tabs_menu">
				<ul id = "tabs_ul">
					<li id = "li_updates" ><a href = "#div_updates" id="home_a" >home</a></li>
					<li id = "li_ediQuotes" ><a href = "#quotes_div" id = "quotes_a">quotes</a></li>
					<li id = "li_images" ><a href = "#images_div" id = "images_a">images</a></li>
					<li id = "li_birthdays" ><a href = "#birthdays_div" id = "birthdays_a">birthdays</a></li>
					<li id = "li_events" ><a href = "#events_div" id = "events_a">events</a></li>
					<li id = "li_contacts"><a href = "#contacts_div" id = "contacts_a">contacts</a></li>
					<li id = "li_message_center"><a href = "#message_center_div" id = "message_center_a">message center</a></li>
				</ul>

				<div id = "div_updates">
					<div id = "post_div_container">
						<textarea id = "post_textarea"></textarea>
					</div><!-- post div container -->
				</div><!-- div updates -->
				
				<div id = "quotes_div">
					<h2 id = "h2_quotes_title">EDISONIANS' QUOTES:</h2>
					<form id = "quotes_to_add_form" name = "quotes_to_add_form">
						<textarea name = "quotes_to_add" id = "quotes_to_add" placeholder = "add quotes here" cols = "50" rows = "3"></textarea><br/>
					</form>
					<span id="forCancel" class = 'warning'>xxx displaying successfully canceled xxx</span>
					 <span id="empty_quotes_warning" class = 'warning'>xxx   Nothing to display. Enter quotes first.   xxx</span>
					<center><button id = "display_quotes_button">display</button></center><br/>
					 
					 <div id = "added_quotes_div"></div><!-- added_quotes_div -->
				</div><!-- quotes div -->
				
				<div id = "birthdays_div">
					<table id = "months">
						<tr>
							<td><table id = "january_birthdays" ></table><!-- january table --></td>
							<td><table id = "february_birthdays" ></table><!-- february table --></td>
						</tr>
						<tr>
							<td><table id = "march_birthdays" ></table></td>
							<td><table id = "april_birthdays" ></table></td>
						</tr>
						<tr>
							<td><table id = "may_birthdays" ></table></td>
							<td><table id = "june_birthdays" ></table></td>
						</tr>
						<tr>
							<td><table id = "july_birthdays" ></table></td>
							<td><table id = "august_birthdays"></table></td>
						</tr>
						<tr>
							<td><table id = "september_birthdays" ></table></td>
							<td><table id = "october_birthdays" ></table></td>
						</tr>
						<tr>
							<td><table id = "november_birthdays" ></table></td>
							<td><table id = "december_birthdays" ></table></td>
						</tr>
					</table><!!!! months !!!!>
				</div><!!!!! birthday calendar !!!!>
			
				<div id = "events_div">
					hahay. anhon ko man ini? no idea na! >.<<br />
					<center><button id = "add_events_button">ADD EVENT</button></center>
					<div id = "add_event_div">
						<form id = "event_form">
							<table id = "add_event_table">
								<tr>
									<td>When:</td> <td><input type = "text" id = "when_event" /></td>
								</tr>
								<tr>
									<td>Where:</td> <td><input type = "text" id = "where_event" /></td>
								</tr>
								<tr>
									<td>Event title:</td> <td><input type = "text" id = "event_title" /></td>
								</tr>
								<tr>
									<td>Event discription:</td> <td><textarea id = "event_discription"></textarea></td>
								</tr>
								<tr>
									<td>Event organizer:</td><td><input type = "text" id = "event_organizer" /></td>
								</tr>
							</table>
						</form>
					</div><!-- add event -->
				</div><!-- events -->
			
				<div id = "contacts_div">
					<center><button id = "add_contact_button">Add Your Contact</button></center><br />
					<div id = "add_contact_div" title = "ADDING YOUR CONTACT">
									<input type = "text" name = "contact_number" id = "contact_number" title = "enter your contact number here"><br/>
										<select name = "contact_network" id = "contact_network">
											<option>Select Network</option>
											<option>Smart Buddy</option>
											<option>Talk 'N Text</option>
											<option>Globe</option>
											<option>TM</option>
											<option>Others</option>
										</select><br />
						<p id = "select_network_warning" class = 'warning'>Please select its network.</p>
						<p id = "empty_contact_field_warning" class = 'warning'>Please enter a valid contact number. Must be 11 digits</p>
						<p id = "already_displayed" class = 'warning'>You already displayed that contact number!</p>
						<p id = "contact_exists" class = 'warning'>The contact number you've entered already exists!</p><br /><br />
						<button id = "dipslay_contacts_button">display</button>
					</div>
					<table id = "display_contacts_table" border = '1'></table>
					<div id = "displaying_confirmation" class = 'confirmation_dialog' title = "DISPLAYING CONFIRMATION ">
						Displaying your contact succeed!
					</div><!-- displaying confirmation -->
					<div id = "continue_adding_confirmation" class = 'confirmation_dialog' title = "HEY!">
						You've already added your contact.<br />
						Are you trying to display your new contact number?
					</div><!-- continue adding confirmation -->
					<div id = "delete_confirmation" class = 'confirmation_dialog' title = "DELETE CONFIRMATIOn">
						Are you serious of doing this?
					</div><!-- delete confirmation div -->
					
					<div id = "contact_actions" title = "CONTACT ACTIONS">
						<div id = "edit_contact_div">
							<input type = "text" name = "new_contact_number" id = "new_contact_number"><br/>
								<select name = "new_contact_network" id = "new_contact_network">
									<option>Select Network</option>
									<option>Smart Buddy</option>
									<option>Talk 'N Text</option>
									<option>Globe</option>
									<option>TM</option>
									<option>Others</option>
								</select><br />
								<p id = "save_contact_confirmation" class = 'warning'>Your contact was successfully changed!</p>
							<p id = "select_network_warning2" class = 'warning'>Please select its network.</p>
							<p id = "empty_contact_field_warning2" class = 'warning'>Please enter a valid contact number. Must be 11 digits.</p>
							<p id = "already_displayed2" class = 'warning'>Same contact number!</p>
							<p id = "contact_exists2" class = 'warning'>The contact number you've entered already exists!</p><br /><br />
							<button id = "save_contacts_button">save</button>
						</div><!-- edit contact div -->
					</div><!-- contact_actions -->
					
				</div><!-- contacts div -->
				<div id = "images_div">
					<div id = "add_photo_div">
						<form enctype = "multipart/form-data" action = "upload_photo.php">
							Choose a photo to upload: <input type = "file" name = "file_to_upload" /></br>
							<input type = "submit" value = "upload photo" />
						</form>
					</div><!-- add photo div -->
				
				</div><!-- images div div -->
				
				<div id = "message_center_div">
					<div id = "message_box_div">
					<span id = "received_messages_span" class = 'message_option'>RECEIVED MESSAGES </span><span id = "sent_messages_span" class = 'message_option'>SENT MESSAGES</span>
						<div id = "edisonians_online_div" />
							
							<table id = "online_users_table"></table>
						</div><!-- edisonians on line div -->
						<div id = "input_div">
							<form id = "message_form">
								<input type = "text" id = "message_field" name = "message_field" /><br />
							</form>
							<input type = "reset" id = "send_message_button" value = "^_^"/> public messages >>>
							
						</div><!-- input div -->
					</div><!-- message box div -->
					<div id = "message_center_area">
					</div><!-- message_center area -->
					
					<div id = "send_private_message_div">
						<p id = "send_private_message_p">
							Send to: <span class = "username_span" id = "send_to_span"></span><br />
							<input type = "text" id = "private_message_field" name = "private_message_field" /><br /><br />
							<input type = "reset" id = "send_private_message_button" value = "send"><button id = "send_cancel_button">cancel</button><br />
						</p>
					</div><!-- send private message div -->
					
					<div class = "overlay_class" id = "received_private_messages_div">
						<button class = "exit_button" id = "exit_received_private_messages_div">exit</button><br/>
						<div id = "received_messages_append">
						</div><!-- received messages append -->
					</div><!-- recieved_private message -->
					<div class = "overlay_class" id = "sent_private_messages_div">
						<button class = "exit_button" id = "exit_sent_private_messages_div">exit</button><br/>
						<div id = "sent_messages_append">
						</div><!-- sent messages append -->
					</div><!-- sent _private_messages div -->
				</div><!-- messages center div -->
			</div> <!-- tabs menu -->
			</div><!-- container -->
			
			<input type = "hidden" name = "current_user_id" id = "current_user_id" />
			<input type = "hidden" name = "current_user_fullname" id = "current_user_fullname" />
			<input type = "hidden" name = "current_user_password" id = "current_user_password" />
			<input type = "hidden" name = "id" id = "id" />
			<input type = "hidden" name = "current_time" id = "current_time" />	
		</body>
</html>
