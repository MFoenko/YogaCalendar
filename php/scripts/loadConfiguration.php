<?php
	session_start();
	$user = $_SESSION['cal_user'];
	$type = $_GET['type'];
	$get = $_GET['get'];

	require("connect_to_database.php");

	if ($get == "ROW"){
		$result = mysqli_query($conn, "SELECT row FROM configurations WHERE user='$user' AND type='$type';");
		$result = mysqli_fetch_row($result);
		echo $result[0];
	}



?>