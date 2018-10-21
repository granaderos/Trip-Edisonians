<?php
	include "../../CLASSES/Data_functions.php";
	
	$sender = $_POST['current_user_fullname'];
	$message = $_POST['message_field'];
	
	$execute_add = new Data_functions;
	$execute_add->add_message($sender, $message);
