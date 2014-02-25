<?php
	session_start();
	$user = $_SESSION['cal_user'];

	$optionsList = $_POST['optionsList'];
	$optionNumber = $_POST['optionNumber'];

	require("connect_to_database.php");
	$result = mysqli_query($conn, "SELECT parameters FROM configurations WHERE user = '$user' && type = 'RCG_OPTIONS_LIST' && row = '$optionNumber'");

	if(mysqli_num_rows($result) > 0){
		
		mysqli_query($conn, "UPDATE configurations SET parameters = '$optionsList' WHERE user = '$user' && type = 'RCG_OPTIONS_LIST' && row = '$optionNumber'");

		echo "old config overwritten";
	}else{
		//insert code
		
		mysqli_query($conn, "INSERT INTO configurations(user, type, row, parameters) VALUES ('$user','RCG_OPTIONS_LIST','$optionNumber','$optionsList')");
		echo "new config saved";
	}







?>