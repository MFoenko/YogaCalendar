<?php
	/*
$mysql_host = "mysql5.000webhost.com"; $mysql_database = "a1631389_assin"; $mysql_user = "a1631389_assin"; $mysql_password = "assassin1"; 

	*/


	session_start();
	require("php/scripts/connect_to_database.php");

	if (!isset($_SESSION['cal_user']))
		require("php/templates/loginScreen.php");
	else
		require("php/templates/homeWnav.php");
?>
