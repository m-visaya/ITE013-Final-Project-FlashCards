<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
?>
<html>
	<head>
		<title>FlashCards</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
	</head>
	<body class="landing is-preload">
	



	
			<header id="header" >
				<a href="#menu">Menu</a>
				<a class="button" href="index.php">Back to Home</a>
			</header>

			
			<nav id="menu">
				<ul class="links stacked">
					<li><a href="index.php" class="button fit primary small">Back to Home</a></li>
					<li><a href="logout.php" class="button fit primary small">Log Out</a></li>
				</ul>
			</nav>

			

		<br style="line-height: 3em;">
			<section id="banner" style="opacity: 90%">
				<header class="major">
					<h1>Account Management</h1>
					<p>Hello, <?php echo $_SESSION['username']; ?>. You may edit your account details here.</p>
				</header>
			</section>



			<section id="accountsettings" class="wrapper style4 special-alt" style="opacity: 90%">
				<div class="inner">
					<section>
						<br><br>
						<h2>Account Settings</h2>
						<p>You may change your account details by inputting your new preferred credentials in the following input forms. You may leave some fields blank in order to retain your information.</p>
					</section>
					<form method="post" action="#">
						<label for="newusername">New Username</label>
						<input type="text" id="newusername" name="newusername"/>
						<label for="newpassword">New Password</label>
						<input type="password" id="newpassword" name="newpassword"/>
						<br>
						<label for="cpassword">Enter Current Password</label>
						<input type="password" id="cpassword" name="cpassword"/>
						<ul class="actions fit">
							<li><input name="updateBtn" type="submit" class="button submit primary" value="Confirm Changes" id ="updateBtn"></li>
						</ul>
					</form>
				</div>
			</section>

			
			<section class="wrapper style1 special alt" style="opacity: 90%">
				<div class="inner">
					
					<ul class="actions special">
						<li><a href="index.php" class="button"  type="submit">Back to Home</a></li>
					</ul>
				</div>
			</section>
		<br style="line-height: 5em;">
			
			

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/browser.min.js"></script>
			<script src="assets/js/breakpoints.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>
			
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script>
	if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}	
	</script>
<?php

include('../php/db.php');
//Php signup

if (isset($_POST['updateBtn'])) {

	$newusername = $_POST['newusername'];
	$newpassword = $_POST['newpassword'];
	$cpassword = $_POST['cpassword'];
	$user_id = $_SESSION['id'];
	$current = $_SESSION['password'];
	
        if($cpassword == $current){
			if($newusername == "") $newusername = $_SESSION['username'];
			if($newpassword == "") $newpassword = $_SESSION['password'];
			
			
			$sql = "UPDATE flash SET username = '$newusername', password = '$newpassword' WHERE id = $user_id";
			
			if(mysqli_query($conn, $sql)){
			$_SESSION['username'] = $newusername;
			$_SESSION['password'] = $newpassword;
			//echo "<script>alert('Account Details Successfully Updated')</script>";
			}
			else {echo "<script>alert('Something went wrong. Please try again.')</script>";}
		}
		else{
			echo "<script>alert('Incorrect password. Please try again.')</script>";
		}
}

?>



	</body>
</html>
<?php
} else {

	header("Location: index.php");

	exit();
}
?>