<?php

	require('db.php');

	$token=$_POST['token'];
	$deviceId=$_POST['deviceid'];


	$startSession="UPDATE users SET sessionid='$token' WHERE deviceid='$deviceId'";

	mysqli_query($conn, $startSession);
?>