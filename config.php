<?php 
//	error_reporting(0);
	include_once("function.php");
	date_default_timezone_set('Asia/Kolkata');
	$host="localhost";

	if($_SERVER['HTTP_HOST'] == "localhost") {	
		$database="xyz"; $username="root"; $password="";
	}
	else {	
		$database="online"; $username="online"; $password="123";
	}
	
	$con = mysqli_connect($host,$username,$password);
	if (!$con) {
	    die('Could not connect : ' . mysqli_error($con));
	}
	mysqli_select_db($con,$database);
?>
