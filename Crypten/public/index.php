<?php
require('../API/db.php');
session_start();


if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==0 || !isset($_SESSION['isLoggedIn'])) {
  header('Location: ../index.php');
}


?>


<!doctype html>


<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Crypten</title>

    <!-- Add to homescreen for Chrome on Android -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">

    <!-- Add to homescreen for Safari on iOS -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">

    <!-- Tile icon for Win8 (144x144 + tile color) -->
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">

    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>

    <script
  src="https://code.jquery.com/jquery-2.2.4.min.js"
  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
  crossorigin="anonymous"></script>


    <script src="https://code.getmdl.io/1.3.0/material.min.js"></script>

    <script>if (window.module) module = window.module;</script>

    <!-- SEO: If your mobile URL is different from the desktop URL, add a canonical link to the desktop page https://developers.google.com/webmasters/smartphone-sites/feature-phones -->
    <!--
    <link rel="canonical" href="http://www.example.com/">
    -->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="styles.css">
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }

    label {
       cursor: pointer;
       /* Style as you please, it will become the visible UI component. */
    }

    #upload-photo {
       opacity: 0;
       position: absolute;
       z-index: -1;
    }
    </style>

    <script>
      function changePDF(newPDF, PDFname)
      {
        // alert('hey');
        // alert('http://localhost/chatburn/electron-pdfjs/pdfjs/web/viewer.html?file=http://localhost/chatburn/Crypten/uploads'+newPDF);
        $('#PDFTitle').text(PDFname);
        $('#sendFileName').val(newPDF);
        $('#PDFContainer').attr('src', 'http://localhost/chatburn/electron-pdfjs/pdfjs/web/viewer.html?file=http://localhost/chatburn/Crypten/uploads/'+newPDF);
      }

      function track()
      {
        $('#PDFContainer').attr('src', 'http://localhost/chatburn/Crypten/public/tracking.html');

      }

      function findCulprit()
      {
       $('#PDFContainer').attr('src',  'http://localhost/chatburn/Crypten/public/culprits/culprit.png');
      }
    </script>

  </head>
  <body oncopy="return false" oncut="return false" onpaste="return false" unselectable="on"
 onselectstart="return false;">
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title" id="PDFTitle">Home</span>
          <div class="mdl-layout-spacer"></div>
          
       <!--    <label class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" for="upload-photo">
            <i class="material-icons">unarchive</i>
          </label> -->

          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" onclick="track();">
          <i class="material-icons">visibility</i>
          </button>

          <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable" id="shareContainer">
            <label class="mdl-button mdl-js-button mdl-button--icon" for="search">
              <i class="material-icons">share</i>
            </label>
            <div class="mdl-textfield__expandable-holder">
            <form action="../API/sharepdf.php" method="POST">
              <input class="mdl-textfield__input" type="email" id="search" name="receiver">
              <input class="mdl-textfield__input" type="hidden" id="sendFileName" name="sendFileName" value="">
              <label class="mdl-textfield__label" for="search">Email</label>
            </form>
            </div>
          </div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <li class="mdl-menu__item">About</li>
            <li class="mdl-menu__item">Contact</li>
            <li class="mdl-menu__item">Legal information</li>
          </ul>
        </div>
      </header>

      <form action="../API/upload.php" method="POST" enctype="multipart/form-data">
      <label class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" for="upload-photo" style="position: fixed; right: 3%; z-index: 200; bottom: 8%; color: white; background: #f23d3d">
        <i class="material-icons">unarchive</i>
      </label>
      <input type="file" name="fileToUpload" id="upload-photo" onchange="$('#submitButton').show()" />
      <input type="submit" name="submit" value="Upload" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="position: fixed; right: 2%; z-index: 200; bottom: 3%; color: white; background: #f23d3d; display: none" id="submitButton">
      </form>

    <!--   <input type="file" name="" class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect mdl-button--colored" style="position: fixed; right: 3%; z-index: 200; bottom: 3%; color: white; background: #f23d3d" >
 -->
      <div class="demo-drawer mdl-layout__drawer mdl-color--blue-grey-900 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
        <center>
        <img src="images/user.jpg" class="demo-avatar"><br>
        <!-- Anup Kumar Panwar -->
        <?php echo($_SESSION['fullname']); ?>
          <div class="demo-avatar-dropdown">
            <span id="driveType">My Files</span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
              <i class="material-icons" role="presentation">arrow_drop_down</i>
              <span class="visuallyhidden">Accounts</span>
            </button>
            <ul class="mdl-menu mdl-menu--bottom-right mdl-js-menu mdl-js-ripple-effect" for="accbtn">
              <!-- <li class="mdl-menu__item">All Files</li> -->
              <a href="./index.php"><li class="mdl-menu__item">My Files</li></a>
              <a href="./index.php?type=inbox"><li class="mdl-menu__item">Inbox</li></a>
              <a href="./index.php?type=logs"><li class="mdl-menu__item">Activity Logs</li>
              <a href="#"><li class="mdl-menu__item" onclick="findCulprit();">Security Breaches</li></a>
              <!-- <li class="mdl-menu__item"><i class="material-icons">add</i>Add another account...</li> -->
            </ul>
          </div>
          </center>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">

        <?php 

        $userid=$_SESSION['userid'];
        $getMyFile="SELECT * FROM uploaded_files WHERE uploaded_by='$userid'";
        
        if (isset($_GET['type'])) {
            
            // echo($userid);
            $fileType=$_GET['type'];
            if ($fileType=="myfiles") {
              $getMyFile="SELECT * FROM uploaded_files WHERE uploaded_by='$userid'";
              $result=mysqli_query($conn, $getMyFile);
              // echo($result);
              // print_r($result);
              while ($r=mysqli_fetch_assoc($result)) {
                echo('<a class="mdl-navigation__link" href="#" onclick="changePDF(\''.$r['filename'].'\',\''.$r['refname'].'\')">'.$r['refname'].'</a>');
              }
            }
            elseif ($fileType=="inbox") {
              $getMyFile="SELECT * FROM sharedfiles, uploaded_files WHERE receiver='$userid' and file_id=fileid";
              $result=mysqli_query($conn, $getMyFile);
              // echo($result);
              // print_r($result);
              echo('<script>
                $("#driveType").text("Inbox");
                $("#shareContainer").hide()
                </script>');
              while ($r=mysqli_fetch_assoc($result)) {
                echo('<a class="mdl-navigation__link" href="#" onclick="changePDF(\''.$r['filename'].'\',\''.$r['refname'].'\')">'.$r['refname'].'</a>');
              }
            }
            // elseif ($fileType=="logs") {
            //   echo(<script>PDFContainer)
            // }

          }

          else
          {
            $getMyFile="SELECT * FROM uploaded_files WHERE uploaded_by='$userid'";
            $result=mysqli_query($conn, $getMyFile);
            // echo($result);
            // print_r($result);
            while ($r=mysqli_fetch_assoc($result)) {
              echo('<a class="mdl-navigation__link" href="#" onclick="changePDF(\''.$r['filename'].'\',\''.$r['refname'].'\')">'.$r['refname'].'</a>');
            }
          }

         


         ?>
         
<!--          <a class="mdl-navigation__link" href="">HomHomeHomeHome<i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">call_received</i></a>
         <a class="mdl-navigation__link" href="">Home</a> -->



         <!--  <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Home</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">inbox</i>Inbox</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">delete</i>Trash</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">report</i>Spam</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Forums</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">flag</i>Updates</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">local_offer</i>Promos</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">shopping_cart</i>Purchases</a>
          <a class="mdl-navigation__link" href=""><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Social</a> -->
          <div class="mdl-layout-spacer"></div>
          <a class="mdl-navigation__link" href="#"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">help_outline</i><span class="visuallyhidden">Help</span></a>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">
            <iframe src="http://localhost/chatburn/Crypten/images/back.png" allowfullscreen="true" webkitallowfullscreen="true" mozallowfullscreen="true" oallowfullscreen="true" msallowfullscreen="true" style="height: 570px" oncopy="return false" oncut="return false" onpaste="return false" id="PDFContainer"></iframe>

          </div>
        </div>
      </main>
    </div>
 
  </body>
</html>
