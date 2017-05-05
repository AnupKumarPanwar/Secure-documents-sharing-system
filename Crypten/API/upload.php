<?php
require('db.php');

session_start();
if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==0 || !isset($_SESSION['isLoggedIn'])) {
  header('Location: ../index.php');
}

$userid=$_SESSION['userid'];


$target_dir = "../uploads/";
$temp=time();
$target_file = $target_dir . basename($temp.$_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
// $target_file= preg_replace('/\s+/', '_', $target_file);


// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    	$uploaded_file_name=$temp.$_FILES["fileToUpload"]["name"];
        $uploaded_files_refname=$_FILES["fileToUpload"]["name"];
    	$upload_query="INSERT INTO uploaded_files (uploaded_by, filename, refname, uploaded_at) VALUES ('$userid', '$uploaded_file_name', '$uploaded_files_refname', now())";
    	if(mysqli_query($conn, $upload_query))
    	{
    		header("Location: ../public/index.php");
    	}
    	else
    	{
    		echo("Error");
    	}
        // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}





?>