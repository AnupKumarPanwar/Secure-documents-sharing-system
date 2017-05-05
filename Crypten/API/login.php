<?php

require('db.php');
session_start();
// $postdata = file_get_contents("php://input");

if (isset($_POST['email']) && isset($_POST['password']))
{
	// $request = json_decode($postdata);
	// mysql_real_escape_string
	$email = mysqli_real_escape_string($conn,$_POST['email']);
	$password=mysqli_real_escape_string($conn,$_POST['password']);


	$LoginQuery="SELECT email, full_name, user_id FROM users WHERE email='$email' and password='$password'";

	$result=mysqli_query($conn, $LoginQuery);

    if (mysqli_num_rows($result)==1) {
        $r=mysqli_fetch_assoc($result);
        $_SESSION['userid']=$r['user_id'];
        $_SESSION['fullname']=$r['full_name'];
        $_SESSION['email']=$email;
        $_SESSION['isLoggedIn']=1;
        header("Location: ../public/index.php");
    }
    else
    {
        $_SESSION['isLoggedIn']=0;
        header("Location: ../index.php");
    }

}

mysqli_close($conn);
?>
