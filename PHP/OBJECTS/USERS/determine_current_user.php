<?php
	session_start();

	include "../../CLASSES/Data_functions.php";
	
	$username_entered = $_SESSION['username_entered'];
	
	$execute_determine = new Data_functions();
	$execute_determine->determine_current_user($username_entered);	
