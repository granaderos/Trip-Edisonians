<?php

	class Database_connection{

        protected $db_name = "edisonians";
        protected $db_host = "localhost";
        protected $db_user = "root";
        protected $db_password = "";
		protected $dbh = null;
		
		function open_connection(){
		 	$this->dbh = new PDO("mysql:host=".$this->db_host.";dbname=".$this->db_name, $this->db_user, $this->db_password);
		}
		
		function close_connection(){
			$this->dbh = null;
		}
		
	}
	
?>
