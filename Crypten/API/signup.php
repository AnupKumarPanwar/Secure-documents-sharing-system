<?php

require('db.php');
session_start();
// $postdata = file_get_contents("php://input");

if (isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['fullname']) && !empty($_POST['email']) && !empty($_POST['password']))
{
	// $request = json_decode($postdata);

	$fullname=mysqli_real_escape_string($conn,$_POST['fullname']);
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password= mysqli_real_escape_string($conn,$_POST['password']);

	
	$LoginQuery="SELECT email, user_id, full_name FROM users WHERE email='$email'";

	$SignupQuery="INSERT INTO users (full_name, email, password, join_date ) values ('$fullname', '$email', '$password', now())";



	$login=mysqli_query($conn, $LoginQuery);

	if (mysqli_num_rows($login)!=0)
	{
		// echo ('{"result":[{"success" : "0", "data":"Email Already Exists"}]}');
		$_SESSION['error_message']="Email Already Exists";
	}
	else
	{
		
					if (mysqli_query($conn, $SignupQuery))
					{
						$_SESSION['fullname']=$fullname;
						$_SESSION['email']=$email;
						$_SESSION['isLoggedIn']=1;

						$r=mysqli_fetch_assoc(mysqli_query($conn, $LoginQuery));
						$_SESSION['userid']=$r['user_id'];
						// echo("Done Resitration");
					}

	}
}

else
{
	// echo ('{"result":[{"success" : "3", "data":"Something Went Wrong"}]}');
		$_SESSION['error_message']="Something Went Wrong";

}

header("Location: ../public/index.php");

mysqli_close($conn);
?>
