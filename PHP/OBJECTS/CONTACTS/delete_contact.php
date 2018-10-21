<?php
	include "../CLASSES/Data_functions.php";
	
	$id = $_POST["id"];
	
	$execute_delete = new data_functions();
	$execute_delete->delete_contact($id);
?>
