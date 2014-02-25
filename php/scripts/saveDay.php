<?php
	session_start();
	$user= $_SESSION['cal_user'];
	$day = $_POST['day'];
	$month = $_POST['month'];
	$year = $_POST['year'];
	$values = $_POST['values'];
	
	require("connect_to_database.php");
	mysqli_query($conn, "DELETE FROM entries WHERE user = '$user' AND day = '$day' AND month = '$month' AND year ='$year';");

	mysqli_query($conn, "INSERT INTO entries (user, day, month, year, entries) VALUES ('$user','$day','$month','$year','$values')");
	
	
?>