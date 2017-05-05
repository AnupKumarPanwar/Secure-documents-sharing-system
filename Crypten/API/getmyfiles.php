<?php 

require('../API/db.php');

if (isset($_GET['type'])) {
    
    // $userid=$_SESSION['userid'];

    $fileType=$_GET['type'];
    if ($fileType="myfiles") {
      $getMyFile="SELECT * FROM uploaded_files WHERE uploaded_by='$userid'";
    }

    $result=mysqli_query($conn, $getMyFile);
    // echo($result);

    while ($r=mysqli_fetch_assoc($result)) {
      echo('<a class="mdl-navigation__link" href="">yoyoyo'.$r['refname'].'</a>');
    }
}


 ?>