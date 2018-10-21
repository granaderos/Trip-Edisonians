<?php

	include 'Database_connection.php';

	class Data_functions extends Database_connection {
    
    function add_user($firstname, $middlename, $lastname, $gender, $age, $month, $day, $year, $address, $new_username, $new_password) {
    	$this->open_connection();
    	
    	$birthdate = $month." ".$day.", ".$year;
    	$log = "out";
    	
    	$insert_statement = $this->dbh->prepare("INSERT INTO users VALUES (null, ?, ?, ?, ?, ?, ?, ?, ?, password(?), ?);");
    	$insert_statement->execute(array($firstname, $middlename, $lastname, $gender, $age, $birthdate, $address, $new_username, $new_password, $log));
		
		$user_fullname = $firstname." ".$middlename." ".$lastname;
		
		$insert_statement2 = $this->dbh->prepare("INSERT INTO birthdays VALUES (null, ?, ?, ?,?)");
		$insert_statement2->bindParam(1, $user_fullname);
		$insert_statement2->bindParam(2, $month);
		$insert_statement2->bindParam(3, $day);
		$insert_statement2->bindParam(4, $year);
		$insert_statement2->execute();
		
    	$this->close_connection();
    }
	
	function check_user($username_entered, $password_entered) {
		$this->open_connection();
		
		$select_statement = $this->dbh->prepare("SELECT username, password FROM users WHERE username = ? AND password = password(?);");
		$select_statement->bindParam(1, $username_entered);
		$select_statement->bindParam(2, $password_entered);
		$select_statement->execute();
		
		if($select_statement->fetch()) {
			$_SESSION['username_entered'] = $username_entered;
			header("Location: edisonians.php");
		} else {
			$error_message = "Undetermined username or password.";
		}
		
		$this->close_connection();
	}
	
	function determine_current_user($username_entered) {
		$this->open_connection();
		
		$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE username = ?");
		$select_statement->bindParam(1, $username_entered);
		$select_statement->execute();
		
		$in = "in";
		
		$update_statement = $this->dbh->prepare("UPDATE users SET log = ? WHERE username = ?");
		$update_statement->bindParam(1, $in);
		$update_statement->bindParam(2, $username_entered);
		$update_statement->execute();
		
		$content = $select_statement->fetch();
		
		$data_array = array("current_user_id"=>$content[0], "current_user_fullname"=>$content[1]." ".$content[2]." ".$content[3]);
		$encoded_data = json_encode($data_array);
		
		echo $encoded_data;
		
		$this->close_connection();
	}
	
	function log_out_user() {
		$this->open_connection();
		
		$out = "out";
		
		$update_statement = $this->dbh->prepare("UPDATE users SET log = ? WHERE username = ?");
		$update_statement->bindParam(1, $out);
		$update_statement->bindParam(2, $_SESSION['username_entered']);
		$update_statement->execute();
		
		$this->close_connection();
	}
		
    //``````` adding contacts `````````````
    
    function check_contact_owner($current_user_fullname) {
    	$this->open_connection();
    	
    	$select_statement = $this->dbh->query("SELECT owner FROM contacts;");
    	
    	$user_already_added_a_contact = false;
    	while($owner = $select_statement->fetch()) {
    		if($owner[0] == $current_user_fullname) {
    			$user_already_added_a_contact = true;
    			break;
    		}
    	}
    	
    	if($user_already_added_a_contact) {
    		echo "true";
    	}
    	
    	$this->close_connection();
    }
    
    function add_contacts($contact_number, $contact_network, $current_user_fullname) {
    	$this->open_connection();
    		
    		$select_statement = $this->dbh->query("SELECT * FROM contacts;");
    		
    		$contact_really_exist = false;
    		$contact_exists = false;
    		
    		while($content = $select_statement->fetch()) {
    			if($content[2] == $contact_number && $content[1] == $current_user_fullname) {
    				$contact_really_exist = true;
    				break;
    			} else {
    				if($content[2] == $contact_number) {
    					$contact_exist = true;
    					
    					break;
    				}
    			}
    		}

    		if($contact_really_exist) {
    			echo "You already displayed that contact number!";
    		} else {
    			if($contact_exists) {
    				echo "The contact number you've entered already exists!";
    			} else {
		 			$insert_statement = $this->dbh->prepare("INSERT INTO contacts VALUES (null, ?, ?, ?);");
			 		$insert_statement->bindParam(1, $current_user_fullname);
			 		$insert_statement->bindParam(2, $contact_number);
			 		$insert_statement->bindParam(3, $contact_network);
			 		$insert_statement->execute();
			 		
			 		$contact_id = $this->dbh->lastInsertId();
			 		
			 		echo "<tr id = '".$contact_id."' onclick = 'execute_action(".$contact_id.")' class = 'pointer_cursor'>
			 					<td>".$current_user_fullname."</td>
			 					<td>".$contact_number."</td>
			 					<td>".$contact_network."</td>
			 				</tr>";
    			}
    		}
    	$this->close_connection();
    }
    
    function display_contacts($current_user_fullname) {
    	$this->open_connection();
    	
    	$select_statement = $this->dbh->query("SELECT * FROM contacts;");

    	echo "<tr>
		 			<th>NAME</th>
		 			<th>CONTACT NUMBER</th>
					<th>NETWORK</th>
    			</tr>";
    			
    	while($content = $select_statement->fetch()) {
    		if($content[1] == $current_user_fullname) {
    			echo "<tr id = '".$content[0]."' onclick = 'execute_action(".$content[0].")' class = 'pointer_cursor'>
		 					<td>".$content[1]."</td>
		 					<td>".$content[2]."</td>
		 					<td>".$content[3]."</td>
		 				</tr>";
    		} else {
		 		echo "<tr id = '".$content[0]."'>
    					<td>".$content[1]."</td>
    					<td>".$content[2]."</td>
    					<td>".$content[3]."</td>
    				</tr>";
    		}
    	}
    	
    	

    	$this->close_connection();
    }
    
    function retrieve_contact($id) {
    	$this->open_connection();
    	
    	$select_statement = $this->dbh->prepare("SELECT * FROM contacts WHERE contact_id = ?;");
    	$select_statement->bindParam(1, $id);
    	$select_statement->execute();
    	
    	$content = $select_statement->fetch();
    	
    	$data_array = array("contact_id"=>$content[0], "contact_number"=>$content[2], "contact_network"=>$content[3]);
    	$encoded_data = json_encode($data_array);
    	
    	echo $encoded_data;
    	
    	$this->close_connection();
    }
    
    function edit_contact($id, $new_contact_number, $new_contact_network, $current_user_fullname) {
    	$this->open_connection();
    	
    	$select_statement = $this->dbh->query("SELECT * FROM contacts;");
    	
    	$edited_contact_really_exists = false;
    	$edited_contact_exists = false;
    	
    	while($content = $select_statement->fetch()) {
    		if($content[2] == $new_contact_number && $content[1] == $current_user_fullname) {
    			$edited_contact_really_exists = true;
    			break;
    		} else {
    			if($content[2] == $new_contact_number) {
    				$edited_contact_exists = true;
    				break;
    			}
    		}
    	}
    	
    	if($edited_contact_really_exists) {
    		echo "You already displayed that contact number!";
    		
    	} else {
    		if($edited_contact_exists) {
    			echo "The contact number you've entered already exists!";
    		} else {
    			$update_statement = $this->dbh->prepare("UPDATE contacts SET contact_number = ?, network = ? WHERE contact_id = ?;");
    			$update_statement->execute(array($new_contact_number, $new_contact_network, $id));
    			echo "<td>".$current_user_fullname."</td><td>".$new_contact_number."</td><td>".$new_contact_network."</td>";
    		}
    	}
    	$this->close_connection();
    }
    
    function delete_contact($id) {
    	$this->open_connection();
    	
		$delete_statement = $this->dbh->prepare("DELETE FROM contacts WHERE contact_id = ?;");
		$delete_statement->bindParam(1, $id);
		$delete_statement->execute();
		
    	$this->close_connection();
    }
    
    
    //----- functions for QUOTES ---------
    
     function add_quotes($current_user_fullname, $quotes_to_add, $current_time){
			$this->open_connection();
			
			$nonspace_quotes = trim($quotes_to_add);
			
			if(!empty($nonspace_quotes)) {
				$quotes = nl2br($quotes_to_add);
				
				$insert_statement = $this->dbh->prepare("INSERT INTO quotes VALUES (null, ?, ?, ?);");
				$insert_statement->execute(array($current_user_fullname, $quotes, $current_time));
			
				$quotes_id = $this->dbh->lastInsertId();

				echo "<p id='".$quotes_id."'class = 'quotes_to_add_class'>".$quotes."<br /><br /><span class = 'font_size_10'>Posted by: <span class = 'for_user_class'>".$current_user_fullname."</span>&nbsp;Posted:&nbsp;<span id = 'quotes_posted_time' class = 'for_current_time'> ".$current_time."</span></span></p>";
	
			}
			$this->close_connection();
		}
		
		function display_quotes(){
		    $this->open_connection();
		    
		    $select_statement = $this->dbh->query("SELECT * FROM quotes ORDER BY quotes_id DESC;");

		    while($content = $select_statement->fetch()){
		        echo "<p id='".$content[0]."'class = 'quotes_to_add_class'>".$content[2]."<br /><br />
		              <span class = 'font_size_10'>Posted by: <span class = 'for_user_class'>".$content[1]."</span>&nbsp;
		              Posted: <span id = 'quotes_posted_time' class = 'for_current_time'> ".$content[3]."</span></span></p>";
		    }
		    
			$this->close_connection();
		}
		
		function deleteQuotes($id){
		    $this->open_connection();
		    
		    $stmt = $this->dbh->prepare("DELETE FROM quotes WHERE id=?");
		    $stmt->bindparam(1, $id);
		    $stmt->execute();
		    
		    $this->close_connection();
		}
		
		function gettingQuotesToEdit($id){
			$this->open_connection();

			$stmt = $this->dbh->prepare("SELECT * FROM quotes WHERE id= ?");
			$stmt->bindParam(1, $id);
			$stmt->execute();
			
			$content = $stmt->fetch();
			$dataArray = array("id"=>$content[0], "quotes"=>$content[1]);
			$encodedData = json_encode($dataArray);

			echo $encodedData;			

			$this->closeConnection();
		}
		
		function saveEditedQuotes($id, $quotes){
			$this->openConnection();

			$stmt = $this->dbh->prepare("UPDATE quotes SET quote = ? WHERE id = ?");
			$stmt->bindParam(1, $quotes);
			$stmt->bindParam(2, $id);
			$stmt->execute();
	
			echo "<p id='".$id."' class = 'q'>".$quotes."
					<input type='button' id='delete' onclick = 'deleteQuotes(".$id.")' value='delete' />
					<input type='button' id='edit' onclick = 'editQuotes(".$id.")' value='edit'></p>";

			$this->closeConnection;
		}		
		
       //----- functions for QUOTES ends here! ----
		
		function display_birthdays() {
			$this->open_connection();
			
			$select_statement = $this->dbh->query("SELECT * FROM birthdays");
			$january = "";
			$february = "";
			$march = "";
			$april = "";
			$may = "";
			$june = "";
			$july = "";
			$august = "";
			$september = "";
			$october = "";
			$november = "";
			$december = "";
			
			while($content = $select_statement->fetch()) {
				if($content[2] == "January") {
					$january = $january."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "February") {
					$february = $february."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "March") {
					$march = $march."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>"; 
				}
				if($content[2] == "April") {
					$april = $april."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "May") {
					$may = $may."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}	
				if($content[2] == "June") {
					$june = $june."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				
				if($content[2] == "July") {
					$july = $july."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";				
				}
				if($content[2] == "August") {
					$august = $august."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "September") {
					$september = $september."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "October") {
					$october = $october."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "November") {
					$november = $november."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
				if($content[2] == "December") {
					$december = $december."<tr><td>".$content[1]."</td><td>".$content[2]." ".$content[3].", ".$content[4]."</td></tr>";
				}
			}
			
			$data_array = array("january_birthdays"=>$january, "february_birthdays"=>$february, "march_birthdays"=>$march, "april_birthdays"=>$march, "may_birthdays"=>$may, "june_birthdays"=>$june, "july_birthdays"=>$july, "august_birthdays"=>$august, "september_birthdays"=>$september, "october_birthdays"=>$october, "november_birthdays"=>$november, "december_birthdays"=>$december);
			$encoded_data = json_encode($data_array);
			
			echo $encoded_data;
			
			$this->close_connection();
		}
		
		function add_message($sender, $message_to_add) {
			$this->open_connection();
			
			$nonspace_message = trim($message_to_add);
			
			if(!empty($nonspace_message)) {
				$message = nl2br($message_to_add);
				
				$insert_statement = $this->dbh->prepare("INSERT INTO message_center VALUES (null, ?, ?)");
				$insert_statement->bindParam(1, $sender);
				$insert_statement->bindParam(2, $message);
				$insert_statement->execute();
			
				echo "<p id = 'message_to_append'><span class = 'username_span'>".$sender."</span>&nbsp;&nbsp;&nbsp;".$message."</p>";
			}

			$this->close_connection();
		}
		
		function display_messages() {
			$this->open_connection();
			
			$select_statement = $this->dbh->query("SELECT * FROM message_center ORDER BY message_id ASC;");
			
			while($content = $select_statement->fetch()) {
				echo "<p id = 'message_to_append'><span class = 'username_span'>".$content[1]."</span>&nbsp;&nbsp;&nbsp;".$content[2]."</p>";
			}
			
			$this->close_connection();
		}
		
		function get_recipient($id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE user_id = ?");
			$select_statement->bindParam(1, $id);
			$select_statement->execute();
			
			$recipient = $select_statement->fetch();
			
			echo $recipient[1]." ".$recipient[2]." ".$recipient[3];
			
			$this->close_connection();
		}
		
		function get_users_on_line($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM users WHERE user_id != ?");	
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
			
			while($content = $select_statement->fetch()) {
				if($content[10] != "in") {
					echo "<tr class = 'user_online_class' id = '".$content[0]."' onclick = 'send_private_message(".$content[0].")'><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$content[1]." ".$content[2]." ".$content[3]."</td></tr>";
				} else {
						echo "<tr class = 'user_online_class' id = '".$content[0]."' onclick = 'send_private_message(".$content[0].")'><td>^_^&nbsp;&nbsp;".$content[1]." ".$content[2]." ".$content[3]."</td></tr>";
				}
			}
			
			$this->close_connection();
		}
		
		function add_private_message($current_user_fullname, $recipient, $private_message, $time_sent) {
			$this->open_connection();
			
			$display_as_received = "yes";
			$display_as_sent = "yes";
			
			$insert_statement = $this->dbh->prepare("INSERT INTO private_messages VALUES (null, ?, ?, ?, ?, ?, ?);");
			$insert_statement->bindParam(1, $current_user_fullname);
			$insert_statement->bindParam(2, $recipient);
			$insert_statement->bindParam(3, $private_message);
			$insert_statement->bindParam(4, $time_sent);
			$insert_statement->bindParam(5, $display_as_received);
			$insert_statement->bindParam(6, $display_as_sent);
			$insert_statement->execute();
			
			$this->close_connection();
		}
		
		function display_private_messages($current_user_id) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT * FROM private_messages WHERE recipient = ? AND display_as_received = 'yes' ORDER BY private_message_id DESC;");
			$select_statement->bindParam(1, $current_user_id);
			$select_statement->execute();
		
			while($content = $select_statement->fetch()) {
				echo "<div class = 'received_message' id = 'received_private_message_".$content[0]."'>
						Message from: <span class = 'for_current_time' id = 'sender_fullname'>".$content[1]."</span>
						<p id = 'private_message_p'>".$content[3]."</p>
						Received: <span id = 'sent_time' class = 'for_current_time'>".$content[4]."</span><br /><button onclick = 'reply(".$content[0].")'>reply</button><button onclick = 'delete_received_private_message(".$content[0].")'>delete</buttton>
					</div>";
			}
			
			$this->close_connection();
		}
		
		function display_sent_messages($current_user_fullname) {
			$this->open_connection();
			
			$select_statement = $this->dbh->prepare("SELECT pm.private_message_id, u.firstname, u.middlename, u.lastname, pm.private_message, pm.time_sent FROM private_messages AS pm, users AS u WHERE u.user_id = pm.recipient AND pm.sender = ? AND display_as_sent = 'yes' ORDER BY pm.private_message_id DESC");
			$select_statement->bindParam(1, $current_user_fullname);
			$select_statement->execute();
			
			while($content = $select_statement->fetch()) {
				echo "<div class = 'sent_message' id = 'sent_private_message_".$content[0]."'>
						Sent to: <span class = 'for_current_time' id = 'receiver_fullname'>".$content[1]. " ".$content[2]." ".$content[3]." </span>
						<p id = 'private_message_p'>".$content[4]."</p>
						Sent: <span id = 'sent_time' class = 'for_current_time'>".$content[5]."</span><br /><button onclick = 'delete_sent_private_message(".$content[0].")'>delete</buttton>
					</div>";
			}
			
			$this->close_connection();
		}
		
		function delete_received_private_message($id) {
		   $this->open_connection();
		   
		   $delete_statement = $this->dbh->prepare("UPDATE private_messages SET display_as_received = 'no' WHERE private_message_id = ?");
		   $delete_statement->bindParam(1, $id);
		   $delete_statement->execute();
		   
		   $delete_statement = $this->dbh->exe("DELETE FROM private_message WHERE display_as_sent = 'no' && display_as_recieved = 'no';");
		   
		   $this->close_connection();
		}
		
		function delete_sent_private_message($id) {
			$this->open_connection();
			
			$delete_statement = $this->dbh->prepare("UPDATE private_messages SET display_as_sent = 'no' WHERE private_message_id = ?;");
			$delete_statement->bindParam(1, $id);
			$delete_statement->execute();
			
			$delete_statement = $this->dbh->exe("DELETE FROM private_message WHERE display_as_sent = 'no' && display_as_recieved = 'no';");
			
			$this->close_connection();
		}
	
	}
?>
