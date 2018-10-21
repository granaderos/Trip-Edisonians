<?php
	include "../CLASSES/Data_functions.php";
	
	$current_user_fullname = $_POST['current_user_fullname'];
	
	$execute_check = new data_functions();
	$execute_check->check_contact_owner($current_user_fullname);
?>
