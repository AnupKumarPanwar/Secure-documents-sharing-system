<?php
	session_start();
	
	if (isset($_SESSION['isLoggedIn']) && $_SESSION['isLoggedIn']==1) {
		header('Location: public/index.php');
	}


$temp=time();



?>

<span style="position: fixed; font-size: 25px; left: 26vw; top: 61vh; z-index:100000"><?php echo($temp); ?></span>



<!DOCTYPE html>
<html>
<head>
	<title>Crypten</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>




	    <script>if (typeof module === 'object') {window.module = module; module = undefined;}</script>
	<script
	  src="https://code.jquery.com/jquery-2.2.4.min.js"
	  integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
	  crossorigin="anonymous"></script>

		  <script type="text/javascript">
		setInterval(function(){
			$.get('http://localhost/chatburn/Crypten/API/checklogin.php?token=<?php echo($temp)?>', function(response){
				console.log(response);
				if(response==1)
				{
					location.reload();
				}
			})
		},5000)
	</script>

	    <script>if (window.module) module = window.module;</script>





	<style type="text/css">
		
			
		.upperDiv
		{
			width: 100vw;
			height: 32vh;
			background: #009688;
		}
		.lowerDiv
		{
			width: 100vw;
			height: 68vh;
			background: #d4dbda;
		}

		.fingerprint
		{
			background: red;
			width: 200px;
			height: 200px;
			background: url('images/fing.png');
			background-size: cover;
			margin-top: 180px;
			margin-left: 80px;
			float: left;
		}

		.simpleLogin
		{
			width: 465px;
			height: 200px;
			margin-top: 70px;
			margin-left: 80px;
			float: left;
			padding: 10px;
		}

		.loginContainer
		{
			width: 100%;
			margin-bottom: 100px;
		}

		.demo-card-wide.mdl-card {
		  width: 64vw;
		  position: fixed;
		  z-index: 100;
		  top: 3vh;
		  left: 18vw;
		}
		.demo-card-wide > .mdl-card__title {
		  color: #fff;
		  height: 176px;
		  background: url('../assets/demos/welcome_card.jpg') center / cover;
		}
		.demo-card-wide > .mdl-card__menu {
		  color: #fff;
		}


	</style>
</head>
<body>
	<div class="upperDiv">		
	</div>
	<div class="lowerDiv"></div>

	<div class="demo-card-wide mdl-card mdl-shadow--2dp">
	<!--   <div class="mdl-card__title">
	    <h2 class="mdl-card__title-text">Welcome</h2>
	  </div> -->
	  <!-- <div class="mdl-card__supporting-text">
	    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
	    Mauris sagittis pellentesque lacus eleifend lacinia...
	  </div> -->
	  <div class="loginContainer">
	  <div class="fingerprint">
	  	
	  </div>


	  <div class="simpleLogin">
	  	<h3 style="color: #37474f">Crypten</h3>
	  	<h5 style="color: #37474f">Crypten makes sharing Cofidential Documents safer and easier</h5>

	  		<form action="http://localhost/chatburn/crypten/API/login.php" method="post" id="loginForm">
	  		  <div class="mdl-textfield mdl-js-textfield">
	  		    <input class="mdl-textfield__input" type="Email" required="" name="email">
	  		    <label class="mdl-textfield__label" for="sample1">Email</label>
	  		  </div>
	  		  <div class="mdl-textfield mdl-js-textfield" style="margin-top: -20px">
	  		    <input class="mdl-textfield__input" type="password" required="" name="password">
	  		    <label class="mdl-textfield__label" for="sample1">Password</label>
	  		  </div>

	  		  <br><br>
	  		  <div class="mdl-textfield mdl-js-textfield">
	  		   	 <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background: #43d854" value="Login">
	  		  </div>

	  		  <a href="#" style=" position: absolute;left: 63%; color: blue" onclick="$('#loginForm').hide(); $('#signupForm').show();">Create Account</a>

	  		</form>



	  		<form action="http://localhost/chatburn/crypten/API/signup.php" method="post" style="display: none" id="signupForm">
	  		  <div class="mdl-textfield mdl-js-textfield">
	  		    <input class="mdl-textfield__input" type="text" required="" name="fullname">
	  		    <label class="mdl-textfield__label" for="sample1">Name</label>
	  		  </div>
	  		  <div class="mdl-textfield mdl-js-textfield" style="margin-top: -20px">
	  		    <input class="mdl-textfield__input" type="Email" required="" name="email">
	  		    <label class="mdl-textfield__label" for="sample1">Email</label>
	  		  </div>
	  		  <div class="mdl-textfield mdl-js-textfield" style="margin-top: -20px">
	  		    <input class="mdl-textfield__input" type="password" required="" name="password">
	  		    <label class="mdl-textfield__label" for="sample1">Password</label>
	  		  </div>

	  		  <br><br>
	  		  <div class="mdl-textfield mdl-js-textfield">
	  		   	 <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background: #43d854" value="Signup">
	  		  </div>

	  		  <p><?echo($_SESSION['error_msg'])?></p>
	  		  <a href="#" style="top:65%; position: absolute;    left: 57%;	color: blue" onclick="$('#loginForm').show(); $('#signupForm').hide();">Already Have an Account</a>

	  		</form>



	  </div>

	  </div>

	  <div class="mdl-card__actions mdl-card--border" style="padding: 40px; background:#f6f8f8">
	    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" style="color: white; background: #43d854">
	      <i class="material-icons">cloud</i>
	    </button>&nbsp;<b>Storage Drive</b>

	    &emsp; &emsp; &emsp;&emsp; 
	    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" style="color: white; background: #43d854">
	      <i class="material-icons">remove_red_eye</i>
	    </button>&nbsp;<b>Highly Confidential</b>

	    &emsp; &emsp; &emsp;&emsp;
	    <button class="mdl-button mdl-js-button mdl-button--fab mdl-js-ripple-effect" style="color: white; background: #43d854">
	      <i class="material-icons">lock</i>
	    </button>&nbsp;<b>Secure Sharing</b>
	  </div>
	  <div class="mdl-card__menu">
	    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
	      <i class="material-icons">share</i>
	    </button>
	  </div>
	</div>


</body>
</html>