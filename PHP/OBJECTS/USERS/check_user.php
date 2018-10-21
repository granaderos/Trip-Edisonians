<?php
	include "../../CLASSES/Data_functions.php";
	$execute_check = new Data_functions();
	
	$username_entered = $_POST['username_entered'];
	$password_entered = $_POST['password_entered'];
	
	$execute_check->log_in($username_entered, $password_entered);
