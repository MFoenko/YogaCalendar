<?php

	require("connect_to_database.php");
	$result = mysqli_query($conn, "SELECT parameters FROM configurations WHERE user = '$user' && type = 'RCG_OPTIONS_LIST' && row = '$optionNum'");


	if(mysqli_num_rows($result) > 0){
		$result = mysqli_fetch_row($result);

		echo "'".$result[0]."'";
	}

?>