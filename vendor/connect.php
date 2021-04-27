<?php 
	// settings
	$host = 'localhost'; 
	$username = 'root'; 
	$password = ''; 
	$db = 'task';

	// Connection
	$_SESSION['con'] = new mysqli($host,$username,$password,$db);
	
	// Check connection
	if($_SESSION['con']->connect_error){
		echo "Connection error!";
	}else{
		// charset
		$_SESSION['con']->query("SET NAMES UTF8");
		mysqli_set_charset($_SESSION['con'], "utf-8");
	}
?>