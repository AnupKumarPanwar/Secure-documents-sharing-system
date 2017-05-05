<?php

require('db.php');
session_start();

if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==0 || !isset($_SESSION['isLoggedIn'])) {
  header('Location: ../index.php');
}


// $postdata = file_get_contents("php://input");

if (isset($_POST['receiver']) && isset($_POST['sendFileName']) && !empty($_POST['receiver']) && !empty($_POST['sendFileName']))
{
	// $request = json_decode($postdata);

	$receiver=mysqli_real_escape_string($conn,$_POST['receiver']);
	$sendFileName = mysqli_real_escape_string($conn,$_POST['sendFileName']);
	$sender= mysqli_real_escape_string($conn,$_SESSION['userid']);

	$getFileId="SELECT * FROM uploaded_files WHERE filename='$sendFileName'";

	$fileId=mysqli_fetch_assoc(mysqli_query($conn, $getFileId))['file_id'];

	$getReceiverId="SELECT user_id FROM users WHERE email='$receiver'";

	$receiverId=mysqli_fetch_assoc(mysqli_query($conn, $getReceiverId))['user_id'];


	$ShareQuery="INSERT INTO sharedfiles (sender, receiver, fileid, send_at ) values ('$sender', '$receiverId', '$fileId', now())";





if (mysqli_query($conn, $ShareQuery))
{
		$_SESSION['error_message']="File Shared Successfully";
}

else
{
	// echo ('{"result":[{"success" : "3", "data":"Something Went Wrong"}]}');
		$_SESSION['error_message']="Something Went Wrong";

}
}

header("Location: ../public/index.php");

mysqli_close($conn);
?>