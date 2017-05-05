<?php
    require('db.php');
    
    session_start();
    if ($_SESSION['email']==NULL || $_SESSION['isLoggedIn']!=2) {
        header('Location: ../index.php');
    }
    else{
        $email=$_SESSION['email'];
    }

    $password=NULL;

    if (isset($_POST['password']) && !empty($_POST['password'])) {
        $password=mysqli_real_escape_string($conn, $_POST['password']);
    }
    else
    {
        header('Location: ../index2.php');
    }

    $loginQuery="SELECT * FROM users WHERE email='$email' AND password collate latin1_general_cs ='$password'";
    
        if(mysqli_num_rows(mysqli_query($conn, $loginQuery))==1) {
            $_SESSION['isLoggedIn']=1;
            
            // $response['data']=1;
            // $response['status']='success';
            // die(json_encode($response));
            header('Location: ../account.php');
            // echo('success');
        }
        else
        {
            // $response['data']=0;
            // $response['status']='Email does not exist';
            // die(json_encode($response));
            header('Location: ../index2.php');
            // echo('failed');
        }
    
?>