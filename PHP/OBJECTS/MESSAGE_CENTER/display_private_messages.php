<?php
	include "../CLASSES/Data_functions.php";
	
	$current_user_id = $_POST['current_user_id'];
	
	$execute_display = new data_functions();
	$execute_display->display_private_messages($current_user_id);
?>
