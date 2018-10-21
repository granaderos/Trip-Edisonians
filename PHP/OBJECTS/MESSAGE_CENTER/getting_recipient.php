<?php
	include "../CLASSES/Data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_get = new data_functions();
	$execute_get->get_recipient($id);
?>
