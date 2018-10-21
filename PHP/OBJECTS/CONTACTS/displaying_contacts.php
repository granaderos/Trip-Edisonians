<?php
	session_start();
	
	include "../CLASSES/Data_functions.php";
	
	$current_user_fullname = $_POST['current_user_fullname'];
	
	$execute_display = new data_functions();
	$execute_display->display_contacts($current_user_fullname);
	
?>
