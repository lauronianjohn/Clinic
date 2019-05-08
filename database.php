<?php 

	session_start();


	$db_host ="localhost";
	$db_name ="clinic";
	$db_user ="root";
	$db_pass = "";
	$db_conn = null;

	try{
		$db_conn = new PDO("mysql:host={$db_host};dbname={$db_name}",$db_user,$db_pass);
		$db_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	}
	catch(PDOException $msg){
		echo $msg->getmessage();
	}

	include"class.php";
	$user = new user($db_conn);
?>