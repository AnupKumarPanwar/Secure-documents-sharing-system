<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Chat Burn</title>
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">
	<script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
</head>
<body>
	
	<center>
		<h3 style="background: -webkit-linear-gradient(#00f, #f00, #000); -webkit-background-clip:text; color: transparent;">Chat Burn</h4>
		<h3>The Ultimate Encrypted Email Service.</h3>
		<h6>Sign in to continue to Chat Burn</h6>
		<!-- Square card -->
		<style>
		.demo-card-square.mdl-card {
		  width: 320px;
		  height: 320px;
		  background: #f7f7f7;
		  padding-top:30px;
		  vertical-align: middle;
		}
		.demo-card-square > .mdl-card__title {
		  color: #fff;
		  background:
		    url('../assets/demos/dog.png') bottom right 15% no-repeat #46B6AC;
		}
		.mdl-card-square {
		}
		</style>

		<div class="demo-card-square mdl-card mdl-shadow--2dp" style="background: #f7f7f7">
		    <img src="./assets/user2.png" style="height: 100px; width: 100px; border-radius: 100%; background: #9dc3ff">
		    <br>
		    <?php echo($_SESSION['email']); ?>
		    <form action="./API/login2.php" method="POST">
		      <div class="mdl-textfield mdl-js-textfield" style="width: 75%">
		        <input class="mdl-textfield__input" type="password" id="sample1" required="true" name="password" autofocus autosave="off">
		        <label class="mdl-textfield__label" for="sample1">Password</label>
		      </div>
		      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent" style="background: #498af2; width: 75%" type="submit">
		       <b>Sign in</b>
		      </button>
		    </form>

		  <!-- <div class="mdl-card__title mdl-card--expand" style="background: #f7f7f7"> -->
		    <!-- <h2 class="mdl-card__title-text">Update</h2> -->
		  <!-- </div> -->
		  <!-- <div class="mdl-card__supporting-text">
		    Lorem ipsum dolor sit amet, consectetur adipiscing elit.
		    Aenan convallis.
		  </div> -->
		  <!-- <div class="mdl-card__actions mdl-card--border">
		    <a class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
		      View Updates
		    </a>
		  </div> -->
		</div>
		<br>
		    <p style="color: #6798f0">Sign in with a different account</p>
		    <br>
		    <br>
		    <p>Chat Burn cannot send or recieve emails from other email services.</p>
	</center>

</body>
</html>