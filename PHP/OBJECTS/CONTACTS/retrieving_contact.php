<?php
	include "../CLASSES/Data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_retrieve = new data_functions();
	$execute_retrieve->retrieve_contact($id);
?>
