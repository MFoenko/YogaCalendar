<?php
	session_start();
	$user = $_SESSION['cal_user'];

	$parameter = $_POST['parameter'];
	$optionNumber = $_POST['optionNumber'];
	$optionType = $_POST['optionType'];

	require("connect_to_database.php");
	$result = mysqli_query($conn, "SELECT parameters FROM configurations WHERE user = '$user' && type = '$optionType' && row = '$optionNumber'");

	if(mysqli_num_rows($result) > 0){
		
		mysqli_query($conn, "UPDATE configurations SET parameters = '$parameter' WHERE user = '$user' && type = '$optionType' && row = '$optionNumber'");

		echo "old config overwritten";
	}else{
		//insert code
		
		mysqli_query($conn, "INSERT INTO configurations(user, type, row, parameters) VALUES ('$user','$optionType','$optionNumber','$optionsList')");
		echo "new config saved";
	}

?>