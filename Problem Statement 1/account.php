<?php

	require('./API/db.php');
	session_start();
	if ($_SESSION['email']==NULL || $_SESSION['isLoggedIn']!=1) {
	    header('Location: ./index.php');
	}
	else{
		$email=$_SESSION['email'];
	}


	$noOfUnreadEmails="SELECT COUNT(*) as n FROM messages WHERE receiver='$email' and is_read=0";
	$n=mysqli_fetch_assoc(mysqli_query($conn, $noOfUnreadEmails));


	$getInboxMessages="SELECT full_name, sender, subject, content, send_at, is_read, message_id FROM messages, users WHERE receiver='$email' and users.email=sender ORDER BY send_at DESC";

	$result=mysqli_query($conn, $getInboxMessages);
	$row=array();
	while ($r=mysqli_fetch_assoc($result)) {
		$row[]=$r;
	}
	// echo(json_encode($row));

?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Burn</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.8/angular.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/rx-angular/1.1.3/rx.angular.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.0.8/angular.min.js"></script>
	<script src="./js/controller.js"></script>
</head>
<body ng-app='chatburn' ng-controller='mailBox' ng-init='getEmails(<?php echo(json_encode($row)) ?>)'>
<style type="text/css">
	.demo-card-wide.mdl-card {
	  width: 512px;
	}
	.demo-card-wide > .mdl-card__title {
	  color: #fff;
	  height: 45px;
	  background: url('../assets/demos/welcome_card.jpg') center / cover;
	}
	.demo-card-wide > .mdl-card__menu {
	  color: #fff;
	}


	.numberCircle {
	  width: 75px;
	  height: 75px;
	  border-radius: 50%;
	  font-size: 50px;
	  color: #fff;
	  line-height: 75px;
	  text-align: center;
	  background: #e74a43;
	  float: left;
	  margin-left: 10px;
	  text-transform: uppercase;
	  margin-top: 55px;
	  cursor: pointer;
	}

	.demo-list-three {
	  width: 650px;
	}

	.composeMailBox {
		width: 500px;
		position: fixed;
		right: 2px;
		bottom: 1px;
		height: 500px;
		z-index: 100;
		background: #edeaea;
	}

	.readEmails{
		background: whitesmoke;
		cursor: pointer;
	}

	.unreadEmails{
		font-weight: bold !important;
		cursor: pointer;
	}

	.unreadEmailIcon{
		background: black !important;
	}
</style>

<script>
	$(document).ready(function(){
		$('#composeMailButton').click(function(){
			$('.composeMailBox').slideDown();
		});
		$('#closeComposeMailBox').click(function(){
			$('.composeMailBox').slideUp();
		})
	})
</script>
	
	<!-- The drawer is always open in large screens. The header is always shown,
	  even in small screens. -->
	<div class="mdl-layout mdl-js-layout mdl-layout--fixed-drawer
	            mdl-layout--fixed-header">
	  <header class="mdl-layout__header">
	    <div class="mdl-layout__header-row">
	        <h3 style="background: -webkit-linear-gradient(#fff, #fff); -webkit-background-clip:text; color: transparent;">Chat Burn</h4>

	      <div class="mdl-layout-spacer"></div>
	      <div class="mdl-textfield mdl-js-textfield mdl-textfield--expandable
	                  mdl-textfield--floating-label mdl-textfield--align-right">
	        <label class="mdl-button mdl-js-button mdl-button--icon"
	               for="fixed-header-drawer-exp">
	          <i class="material-icons">search</i>
	        </label>
	        <div class="mdl-textfield__expandable-holder">
	          <input class="mdl-textfield__input" type="text" name="sample"
	                 id="fixed-header-drawer-exp">
	        </div>
	      </div>
	      <div class="numberCircle" ng-click=loginFromSavedUsers(user) on-hold=deleteSavedUser(user)>A</div>
	    </div>
	  </header>
	  <div class="mdl-layout__drawer">
	    <span class="mdl-layout-title"><button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect" id="composeMailButton">
  COMPOSE
</button></span>
	    <nav class="mdl-navigation">
	      <a class="mdl-navigation__link" href="./account.php"><span class="mdl-badge" data-badge="<?php echo($n['n']); ?>">Inbox</span></a>
	      <a class="mdl-navigation__link" href="./sendBox.php">Sent Mail</a>
	      <!-- <a class="mdl-navigation__link" href="">Link</a> -->
	      <!-- <a class="mdl-navigation__link" href="">Link</a> -->
	    </nav>
	  </div>
	  <main class="mdl-layout__content">
	    <div class="page-content">
	    <!-- Your content goes here -->
	    	<!-- Three Line List with secondary info and action -->
	   
	    	<ul class="demo-list-five mdl-list" ng-show="!is_expanded">

	    	  <li class="mdl-list__item mdl-list__item--three-line" ng-repeat="Email in inboxEmails" ng-class="{'unreadEmails':Email.is_read==0, 'readEmails':Email.is_read==1}" ng-click="expandEmail(Email)">
	    	    <span class="mdl-list__item-primary-content">
	    	      <i class="material-icons mdl-list__item-avatar" ng-class="{'unreadEmailIcon':Email.is_read}">person</i>
	    	      <span>{{Email.full_name}}</span>
	    	      <span class="mdl-list__item-text-body" ng-class="{'unreadEmails':Email.is_read==0}">
	    	        {{Email.subject}}
	    	      </span>
	    	    </span>
	    	    <span class="mdl-list__item-secondary-content">
	    	      {{Email.send_at}}
	    	    </span>
	    	  </li>
	    	  <!-- <li class="mdl-list__item mdl-list__item--three-line">
	    	    <span class="mdl-list__item-primary-content">
	    	      <i class="material-icons  mdl-list__item-avatar">person</i>
	    	      <span>Aaron Paul</span>
	    	      <span class="mdl-list__item-text-body">
	    	        Aaron Paul played the role of Jesse in Breaking Bad. He also featured in
	    	        the "Need For Speed" Movie.
	    	      </span>
	    	    </span>
	    	    <span class="mdl-list__item-secondary-content">
	    	      <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
	    	    </span>
	    	  </li>
	    	  <li class="mdl-list__item mdl-list__item--three-line">
	    	    <span class="mdl-list__item-primary-content">
	    	      <i class="material-icons  mdl-list__item-avatar">person</i>
	    	      <span>Bob Odenkirk</span>
	    	      <span class="mdl-list__item-text-body">
	    	        Bob Odinkrik played the role of Saul in Breaking Bad. Due to public fondness for the
	    	        character, Bob stars in his own show now, called "Better Call Saul".
	    	      </span>
	    	    </span>
	    	    <span class="mdl-list__item-secondary-content">
	    	      <a class="mdl-list__item-secondary-action" href="#"><i class="material-icons">star</i></a>
	    	    </span>
	    	  </li> -->
	    	</ul>




	    	<div style="padding: 2%" ng-show="is_expanded" >
	    	  <span  style="cursor: pointer; color: black">
	    	    <i class="material-icons" style="color:black" ng-click="is_expanded=false">reply</i>
	    	  </span>
	    	</div>

	    	<div class="demo-card-wide mdl-card mdl-shadow--2dp" style="padding: 2%; width: 100%" ng-show="is_expanded">
	    	<p><b>{{emailContent.full_name}}</b> &nbsp; <{{emailContent.sender}}></p>
	    	  <div class="mdl-card__title">
	    	    <h2  style="color: black; font-size: 25px;">{{emailContent.subject}}</h2>
	    	  </div>
	    	  <div class="mdl-card__supporting-text" id="encryptedEmailContent" style="word-wrap: break-word;">
	    	  	<p style="white-space: pre;" ng-bind-html-unsafe="emailContent.content"></p>
	    	  </div>
<!-- 	    	  <div class="mdl-card__actions mdl-card--border">

	    	    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
	    	      Decrypt
	    	    </a>
	    	  </div> -->
	    	  <div class="mdl-textfield mdl-js-textfield" style="width: 450px; margin-left: 25px; margin-top: -25px">
	    	    <input class="mdl-textfield__input" type="password" id="sample7" required="true" name="password" style="width: 370px;" autocomplete="off" ng-model="decryptionPassword">
	    	    <label class="mdl-textfield__label" for="sample2">Key for email</label>
	    	     <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="margin-top: -28px; margin-left: 25px; position: absolute; right: 0px" type="submit" ng-click="decryptMessage(decryptionPassword)">
	    	     Decrypt
	    	   </button>
	    	  </div>
	    	  <div class="mdl-card__menu">
	    	    <span  style="cursor: default; color: black">
	    	      <!-- <i class="material-icons" style="color:black">share</i> -->
	    	      {{emailContent.send_at}}
	    	    </span>
	    	  </div>
	    	</div>








	    </div>
	  </main>
	</div>



	<div class="composeMailBox" style="display: none;">
		<div style="width: 94%; background: #404040; color: white; font-size: 17px; padding: 3%">
			New Message
			<i class="material-icons" style="position: absolute; right: 2px; cursor: pointer;" id="closeComposeMailBox">clear</i>
		</div>
		<form action="./API/send.php" method="POST">
		  <div class="mdl-textfield mdl-js-textfield" style="width: 450px; margin-left: 25px">
		    <input class="mdl-textfield__input" type="Email" id="sample1" required="true" name="receiver">
		    <label class="mdl-textfield__label" for="sample1">Reciepient</label>
		  </div>
		  <div class="mdl-textfield mdl-js-textfield" style="width: 450px; margin-left: 25px; margin-top: -25px">
		    <input class="mdl-textfield__input" type="text" id="sample2" required="true" name="subject" autocomplete="off">
		    <label class="mdl-textfield__label" for="sample2">Subject</label>
		  </div>
		  <div class="mdl-textfield mdl-js-textfield" style="width: 450px; margin-left: 25px; margin-top: -25px;">
		    <textarea class="mdl-textfield__input" type="text" id="sample3" style="height: 280px" required="true" name="content"></textarea>
		   <!--  <input class="mdl-textfield__input" type="text" id="sample3" style="height: 280px" required="true" name="content">
 -->		    <label class="mdl-textfield__label" for="sample3"></label>
		  </div>
		  <div class="mdl-textfield mdl-js-textfield" style="width: 450px; margin-left: 25px; margin-top: -25px">
		    <input class="mdl-textfield__input" type="password" id="sample4" required="true" name="password" style="width: 370px;" autocomplete="off">
		    <label class="mdl-textfield__label" for="sample4">Key for email</label>
		     <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" style="margin-top: -28px; margin-left: 25px; position: absolute; right: 0px" type="submit">
		     Send
		   </button>
		  </div>
		  
		</form>
	</div>









</body>
</html>