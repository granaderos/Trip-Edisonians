<?php

	include "../CLASSES/Data_functions.php";
	
	$current_user_fullname = $_POST["current_user_fullname"];
	$recipient = $_POST["id"];
	$private_message = $_POST["private_message_field"];
	$time_sent = $_POST["current_time"];
	
	$execute_add = new data_functions();
	$execute_add->add_private_message($current_user_fullname, $recipient, $private_message, $time_sent);
	
?>
