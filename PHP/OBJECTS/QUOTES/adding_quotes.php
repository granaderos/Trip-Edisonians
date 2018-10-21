<?php
    include '../../CLASSES/Data_functions.php';
    
    
    $current_user_fullname = $_POST['current_user_fullname'];
    $quotes_to_add = $_POST['quotes_to_add'];
    $current_time = $_POST['current_time'];
  
    $execute_add = new Data_functions();
    $execute_add->add_quotes($current_user_fullname, $quotes_to_add, $current_time);
