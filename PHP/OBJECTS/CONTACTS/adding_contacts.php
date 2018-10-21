<?php
	session_start();
	
	include "../CLASSES/Data_functions.php";
	
	$contact_number = $_POST['contact_number'];
	$contact_network = $_POST['contact_network'];
	$current_user_fullname = $_POST['current_user_fullname'];	
	
	$execute_add = new data_functions();
	$execute_add->add_contacts($contact_number, $contact_network, $current_user_fullname);
	
?>
