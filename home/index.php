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





		<header id="header">
			<a href="#menu">Menu</a>
			
			<a class="button" href="#createsets">Create New Set</a>
			<a class="button" href="#cardsets">View Card Sets</a>
		</header>


		<nav id="menu">
			<h4 style="text-align: center">Your Card Sets</h4>
			<ul class="links" id="menusets">
				<li><a href="#">Home</a></li>
			</ul>
			<ul class="links stacked">
				<li><input id="search" type="text" placeholder="Enter card set name..." style="margin-bottom:-8px"/></li>
				<li><a id="searchBtn" class="button fit small" href="#cardsets">Search</a></li>
				<br>
				<li><a href="account.php" class="button fit primary small">Account Settings</a></li>
				<li><a href="logout.php" class="button fit primary small">Log Out</a></li>
				
				

			</ul>
		</nav>



		<br style="line-height: 3em;">
		<section id="banner" style="opacity: 90%">
			<header class="major">
				<h1>FlashCards</h1>
				<p>Welcome back, <?php echo $_SESSION['username']; ?>. You may now access and manage your card sets below.</p>
			</header>
			<ul class="actions special">
				<li><a href="#one" class="button scrolly primary">Proceed</a></li>
			</ul>
		</section>




		<section id="one" class="wrapper style1 special" style="opacity: 90%">
			<div class="inner">
				<header class="major alt style2">
					<h2>Your Workspace</h2>
					<p>Manage everything in your account by scrolling down to view our features!</p>
				</header>
				<section class="split">
					<article>
						<h4>Account Management</h4>
						<p>You can easily access your account setting by clicking the button below or the one located in the burger menu presented in the upper-left corner of the screen.</p>
						<ul class="actions special">
							<li><a href="account.php" class="button">View Settings</a></li>
						</ul>
					</article>
					<article>
						<h4>Flashcard Management</h4>
						<p>Browse, create, edit, or delete your flashcards by interacting with the user interface containing buttons that label the actions that you could do within it!</p>
						<ul class="actions special">
							<li><a href="#createsets" class="button">Start Now</a></li>
						</ul>
					</article>
				</section>
			</div>
		</section>
		<br style="line-height: 200px">





		<section id="cardsets" class="wrapper style3 special" style="opacity: 90%">
			<div class="inner">
				<header class="major">
					<h2>Your card sets</h2>
					<p>Listed below are your current card sets. You may click the open or delete buttons in order to manage the sets that are available.</p>


				</header>
				<div id="error_search"></div>
				<section class="spotlights" id="quizzes">





				</section>

			</div>
		</section>





		<section id="createsets" class="wrapper style4 special-alt" style="opacity: 90%">
			<div class="inner split">
				<section>
					<header class="major">
						<h2>New Card Set</h2>
					</header>
					<p>You can create a new card set using the nearby form. You could input a topic or a specific quiz for its name and you could also provide a brief description to stay organized!</p>
				</section>
				<form method="post" action="#">
					<label for="name">Name</label>
					<input type="text" id="quiz-name" name="name" required />
					<label for="desc">Description</label>
					<textarea name="desc" id="quiz-desc" rows="3" style="resize: none"></textarea>
					<ul class="actions">
						<li><a href="#cardsets	" class="button" id="createBtn" type="submit">Create</a></li>
					</ul>
				</form>
			</div>
		</section>


		<section class="wrapper style1 special alt" style="opacity: 90%">
			<div class="inner">
				<h4>Feeling tired?</h4>
				<p>You could always take a short break and gain some momentum later on.<br>Click the button below in order to log out and return at a later time.</p>
				<form action="logout.php">
					<ul class="actions special">
						<li><button class="button" id="logout" type="submit">Log Out</button></li>
					</ul>
				</form>
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

		<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
		<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


		<script>
			var user_id = <?php echo $user_id ?>;
			Load(user_id);


			$("#createBtn").click(function() {

				//console.log($("#addquizform").serialize());
				$.ajax({
					url: "quiz-api/createquiz.php",
					type: "POST",
					data: {
						"quizname": $('#quiz-name').val(),
						"quizdescription": $('#quiz-desc').val(),
						"user_id": user_id,
					},
					success: function(response) {
						//console.log(response);
						if (response.code == '201') {
							//alert('Card set created successfully');
							$("input[type=text], textarea").val("");
							Load(user_id);
						} else {
							console.log('Error');
						}
					}
				});
			});

			$("#searchBtn").click(function() {
				Search(user_id);
			});

			function Search(user_id) {
				//$("#quizzes").remove();
				document.getElementById("quizzes").innerHTML = "";
				document.getElementById("menusets").innerHTML = "";
				var search = "%" + $('#search').val() + "%";
				$.ajax({
					url: "quiz-api/searchquiz.php",
					type: "POST",
					data: {
						"user_id": user_id,
						"search": search,
					},
					success: function(response) {
						if (response.length != '0') {
							response.forEach(function(quiz, index) {
								if (quiz.name == "") quiz.name = "No Title";
								if (quiz.description == "") quiz.description = "No Description";
								$('#quizzes').append(
									$('<section id = "set' + quiz.id + '"><h4>' + quiz.name + '</h4><p>' + quiz.description + '</p><ul class="actions special"><li><a href="#cardsets" class="button small scrolly" id="deleteBtn" data-id="' + quiz.id + '">Delete</a></li><li><a class="button small scrolly" id="viewBtn" data-id="' + quiz.id + '">Open</a></li></ul></section>')
								);

								$('#menusets').append(
									$('<li><a class="button small scrolly" href ="#set' + quiz.id + '">' + quiz.name + '</a></li>')
								);
							});
						} else {
							$('#error_search').append(
								//$('<h5>Results not found</h5>')
							);
						}
					}
				});
			}



			function Load(user_id) {
				//$("#quizzes").remove();
				document.getElementById("quizzes").innerHTML = "";
				document.getElementById("menusets").innerHTML = "";
				$.ajax({
					url: "quiz-api/listquiz.php",
					type: "POST",
					data: {
						"user_id": user_id,
					},
					success: function(response) {
						response.forEach(function(quiz, index) {
							if (quiz.name == "") quiz.name = "No Title";
							if (quiz.description == "") quiz.description = "No Description";
							$('#quizzes').append(
								$('<section id = "set' + quiz.id + '"><h4>' + quiz.name + '</h4><p>' + quiz.description + '</p><ul class="actions special"><li><a href="#cardsets" class="button small scrolly" id="deleteBtn" data-id="' + quiz.id + '">Delete</a></li><li><a class="button small scrolly" id="viewBtn" data-id="' + quiz.id + '">Open</a></li></ul></section>')
							);

							$('#menusets').append(
								$('<li><a class="button small scrolly" href ="#set' + quiz.id + '">' + quiz.name + '</a></li>')
							);



						});
					}
				});
			}





			$(document).on('click', '#viewBtn', function() {
				let quizid = $(this).data('id');
				$.ajax({
					url: "quiz-api/go-to-flashcards.php",
					type: "POST",
					data: {
						"quizid": quizid
					},
					success: function(response) {
						window.location.href = 'set.php';
					}
				})
			});








			// $(document).on('click', '#modalDelBtn', function(){
			// 	let quizid = $(this).data('id');
			// 	$('#deleteBtn').attr('data-id', quizid);
			// 	console.log(quizid);
			// });

			$(document).on('click', '#deleteBtn', function() {
				let quizid = $(this).data('id');
				//console.log(quizid);
				if (true) {
					$.ajax({
						url: "quiz-api/deletequiz.php",
						type: "POST",
						data: {
							"quizid": quizid
						},
						success: function(response) {
							//console.log(response);
							if (response.code == '201') {
								//alert('Card set deleted successfully');
								//window.location.reload();
								Load(user_id);
							}
							if (response.code == '400') {
								console.log('Error');
							}
						}
					});
				}
			});
		</script>



	</body>

	</html>
<?php
} else {

	header("Location: index.php");

	exit();
}
?>