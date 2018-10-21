<?php
	session_start();

	include "PHP/USERS/Data_functions.php";
	$execute_log_out = new data_functions();
	
	if(isset($_SESSION['username_entered'])) {
		
		$execute_log_out->log_out_user();
		session_unset();
		session_destroy();

		header("Location: edisonians_log_in.php");
	
	} else {
		header("Location: edisonians_log_in.php");
	}
	
?>
