<?php
	include "../CLASSES/Data_functions.php";
	
	$id = $_POST["id"];
	$new_contact_number = $_POST["new_contact_number"];
	$new_contact_network = $_POST["new_contact_network"];
	$current_user_fullname = $_POST["current_user_fullname"];
	
	$execute_update = new data_functions();
	$execute_update->edit_contact($id, $new_contact_number, $new_contact_network, $current_user_fullname);
?>
