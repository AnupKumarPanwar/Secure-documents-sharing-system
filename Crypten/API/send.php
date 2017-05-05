<?php
    require('db.php');
    
    session_start();
    if ($_SESSION['email']==NULL || $_SESSION['isLoggedIn']!=1) {
        header('Location: ../index.php');
    }
    else{
        $email=$_SESSION['email'];
    }

    if (isset($_POST['receiver']) && !empty($_POST['receiver']) && isset($_POST['subject']) && !empty($_POST['subject']) && isset($_POST['content']) && !empty($_POST['content']) && isset($_POST['password']) && !empty($_POST['password'])) {
        $sender=$_SESSION['email'];
        $receiver=mysqli_real_escape_string($conn, $_POST['receiver']);
        $subject=mysqli_real_escape_string($conn, $_POST['subject']);
        $content=$_POST['content'];
        $password=$_POST['password'];
    }
    else
    {
        header('Location: ../index2.php');
    }


    function Encrypt($password, $data)
    {

        $salt = substr(md5(mt_rand(), true), 8);

        $key = md5($password . $salt, true);
        $iv  = md5($key . $password . $salt, true);

        $ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);

        return base64_encode('Salted__' . $salt . $ct);
    }

    $encryptedMessage= Encrypt($password, $content);

    $sendEmail="INSERT INTO messages (sender, receiver, subject, content, send_at, is_read) VALUES ('$sender', '$receiver', '$subject', '$encryptedMessage', now(), 0)";
    
        if(mysqli_query($conn, $sendEmail)) {
            // $_SESSION['isLoggedIn']=1;
            
            // $response['data']=1;
            // $response['status']='success';
            // die(json_encode($response));
            $_SESSION['sendMailStatus']='Email sent successfully';
            header('Location: ../sendBox.php');
            // echo('success');
        }
        else
        {
            // $response['data']=0;
            // $response['status']='Email does not exist';
            // die(json_encode($response));
            $_SESSION['sendMailStatus']='Email sending failed';
            header('Location: ../sendBox.php');
            // echo('failed');
        }
    
?>