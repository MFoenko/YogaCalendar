<?php
	// get variables
	session_start();
	$user = $_SESSION['cal_user'];
	$month = $_POST['month'];
	$year = $_POST['year'];

	// connect to databse ($conn is mysqli connection)
	require("connect_to_database.php");
	// gets days
	$result = mysqli_query($conn, "SELECT day, entries 
									FROM entries
									WHERE month = '$month' AND year = '$year' AND user = '$user'
									ORDER BY day DESC"
	);

	//constructs delimited string
	$delimitedString = "";
	for ($numRows = mysqli_num_rows($result); $numRows > 0; $numRows--){
		$row = mysqli_fetch_assoc($result);
		$delimitedString .= $row['day']."[,]".$row['entries'];
		$delimitedString .= "[|]";
	}

	//echos delimited string
	echo $delimitedString;
?>