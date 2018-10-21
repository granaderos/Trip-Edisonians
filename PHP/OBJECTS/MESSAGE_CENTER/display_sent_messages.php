<?php
	include "../CLASSES/Data_functions.php";
	
	$current_user_fullname = $_POST["current_user_fullname"];
	
	$execute_display = new data_functions();
	$execute_display->display_sent_messages($current_user_fullname);
?>
