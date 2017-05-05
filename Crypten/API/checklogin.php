<?php
	
	require('db.php');

	$token=$_GET['token'];

	$checkLogin="SELECT * FROM users WHERE sessionid='$token'";

	$result=mysqli_query($conn, $checkLogin);

	if(mysqli_num_rows($result)==1)
	{
		$r=mysqli_fetch_assoc($result);
		session_start();
			$_SESSION['userid']=$r['user_id'];
		       $_SESSION['fullname']=$r['full_name'];
		       $_SESSION['email']=$r['email'];
		       $_SESSION['isLoggedIn']=1;
		       // $response['data']='done';
		       // echo(json_encode($response));
		       echo('1');
		       // header("Location: ../public/index.php");
	}
	else
	{
		// $response['data']='notdone';
		// echo(json_encode($response));
		echo('0');
	}

?>