<?php

    require('db.php');
    $email=NULL;

    if (isset($_POST['email']) && !empty($_POST['email'])) {
        $email=mysqli_real_escape_string($conn, $_POST['email']);
    }
    else
    {
        header('Location: ../index.php');
    }

    $checkIfEmailExists="SELECT * FROM users WHERE email='$email'";
    
        if(mysqli_num_rows(mysqli_query($conn, $checkIfEmailExists))==1) {
            session_start();
            $_SESSION['email']=$email;
            $_SESSION['isLoggedIn']=2;
            
            // $response['data']=1;
            // $response['status']='success';
            // die(json_encode($response));
            header('Location: ../index2.php');
        }
        else
        {
            // $response['data']=0;
            // $response['status']='Email does not exist';
            // die(json_encode($response));
            header('Location: ../index.php');
        }
    
?>