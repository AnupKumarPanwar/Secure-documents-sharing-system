<?php

require('db.php');

session_start();
if ($_SESSION['email']==NULL || $_SESSION['isLoggedIn']!=1) {
    header('Location: ./index.php');
}
else{
	$email=$_SESSION['email'];
}


if (isset($_POST['message_id']) && !empty($_POST['message_id']) && isset($_POST['password']) && !empty($_POST['password'])) {
	$message_id=$_POST['message_id'];
	$password=$_POST['password'];
}
else{
	header('Location: ../account.php');
}

// echo($_POST['message'] . ' '. $_POST['password']);

$getMessageFromId="SELECT content FROM messages WHERE message_id='$message_id'";

$r=mysqli_fetch_assoc(mysqli_query($conn, $getMessageFromId));

function Decrypt($password, $data)
{

    $data = base64_decode($data);
    $salt = substr($data, 8, 8);
    $ct   = substr($data, 16);

    $key = md5($password . $salt, true);
    $iv  = md5($key . $password . $salt, true);

    $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

    return $pt;
}

$response=Decrypt($password, $r['content']);
$response=str_replace('\r\n', '<br>', $response);
echo ($response);
?>