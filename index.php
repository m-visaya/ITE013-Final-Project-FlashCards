<html>
<head>
	<title>FlashCards</title>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
	<link rel="stylesheet" href="assets/css/main.css" />
</head>

<body class="is-preload-0 is-preload-1">
	<!-- Wrapper -->
	<div id="wrapper">

		<!-- Home -->
		<article id="home" class="panel special">
			
			<div class="content">
				<div class="inner">
					<header>
						<h1>FlashCards</h1>
						<p>
							A better way to review</p>
					</header>
					<nav id="nav">
						<ul class="actions stacked animated spinY">

							<li><a href="#login" class="button primary">Login</a></li>
							<li><a href="#signup" class="button primary">Sign up</a></li>
							<li><a href="#about" class="button primary">About</a></li>
						</ul>
					</nav>
				</div>
			</div>
			
		</article>

		<!--signup -->
		<article id="signup" class="panel secondary">
			
			<div class="content">
				<ul class="actions animated spinX">
					<li><a href="#" class="button small back">Back</a></li>
				</ul>
				<div class="inner">
					<header>
						<h2>Sign up</h2>
						<p>Please fill up the following form with your desired information.</p>
					</header>
					<form method="post" action="#">
						<div class="fields">
							<div class="field half">
								<label for="su_uname">Username</label>
								<input type="text" name="su_uname" required />
							</div>
							<div class="field half">
								<label for="su_email">Email</label>
								<input type="email" name="su_email" required />
							</div>
							<div class="field">
								<label for="su_pass">Password</label>
								<input type="password" name="su_pass" required />
							</div>
							<div class="field">
								<label for="su_cpass">Confirm Password</label>
								<input type="password" name="su_cpass" required />
							</div>
						</div>
						<ul class="actions">
							<li><input name="signup" type="submit" class="button submit primary" value="sign up"></li>
						</ul>
					</form>
				</div>
			</div>
		</article>


		<!-- Login -->
		<article id="login" class="panel secondary">
			<div class="content">
				<ul class="actions animated spinX">
					<li><a href="#" class="button small back">Back</a></li>
				</ul>
				<div class="inner">
					<header>
						<h2>Welcome back</h2>
						<p>Please enter your credentials below</p>
					</header>
					<form id="log_form" method="post" action="php/login.php">
						<div class="fields">
							<div class="field">
								<label for="loguser">Username</label>
								<input type="text" name="loguser" required />
							</div>
							<div class="field">
								<label for="logpass">Password</label>
								<input type="password" name="logpass" required />
							</div>
						</div>
						<ul class="actions">
							<li><input name="loginLog" type="submit" class="button submit primary" value="Login"></li>
						</ul>
					</form>
				</div>
			</div>
		</article>
		<!-- About -->
		<article id="about" class="panel secondary">
			<div class="content">
				<ul class="actions animated spinX">
					<li><a href="#" class="button small back">Back</a></li>
				</ul>
				<div class="inner">
					<header>
						<h2>About</h2>
					</header>
					<p>This project would provide users a way to create an account that would store and categorize personal flashcards that they would create.
						These flashcards could be private, public, or be shared to specific individuals for collaboration.
						These flashcards can be categorized in order for individuals to easily create a set that would tackle a specific subject or topic.
						The web application is able to be accessed by any individual who has an internet connection and it would be responsive depending on the user's device resolution for a smooth interaction with the application.
						This project can help the students to be more efficient in their studies.
					</p>
				</div>
			</div>
		</article>
	</div>
	<!-- Scripts -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/browser.min.js"></script>
	<script src="assets/js/breakpoints.min.js"></script>
	<script src="assets/js/util.js"></script>
	<script src="assets/js/main.js"></script>

	<!-- Ajax -->
	<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</body>

</html>


<?php

include('php/db.php');
//Php signup

if (isset($_POST['signup'])) {

	$uname = $_POST['su_uname'];
	$email = $_POST['su_email'];
	$pass = $_POST['su_pass'];
	$cpass = $_POST['su_cpass'];

	if ($pass != $cpass) {
		echo "<script>alert('Passwords don\'t match')</script>";
	} else {
		$sql = "INSERT INTO flash (username, email, password) 
		VALUES ('$uname', '$email' , '$pass')";

		if (mysqli_query($conn, $sql)) {
			//echo "<script>alert('New Record Created Successfully')</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
	}
	mysqli_close($conn);
}

?>