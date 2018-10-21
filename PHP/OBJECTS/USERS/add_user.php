<?php
	include "../../CLASSES/Data_functions.php";
	
	$data = $_POST["data"];
	$decoded_data = json_decode($data, true);
	
	foreach($decoded_data as $content) {
		$$content['name'] = $content['value'];
	}
	
	$execute_add = new data_functions();
	$execute_add->add_user($firstname, $middlename, $lastname, $gender, $age, $month, $day, $year, $address, $new_username, $new_password) ;
?>
