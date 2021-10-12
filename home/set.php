<?php
session_start();

if (isset($_SESSION['username']) && isset($_SESSION['password']) && isset($_SESSION['id'])) {
	$user_id = $_SESSION['id'];
	$quiz_id =  $_SESSION['quizid'];
?>
	<html>

	<head>
		<title>FlashCards</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />

		<style>
			.card {
				width: 69%;
				margin: auto;
				padding: 2em;
				border-radius: 10em;

			}

			.card__inner {
				position: relative;
				text-align: center;
				transition: transform 0.5s;
				transform-style: preserve-3d;
				cursor: pointer;
				background-image: url("assets/css/images/overlay.png");
				background-position: center top;
				background-repeat: repeat;

			}

			.card__inner.is-flipped {
				transform: rotateY(180deg);
			}


			.card__front,
			.card__back {
				position: absolute;
				display: flex;
				align-items: center;
				justify-content: center;
				width: 100%;
				height: 100%;
				-webkit-backface-visibility: hidden;
				backface-visibility: hidden;
			}

			.card__front {
				background-color: #1b2a2f;
				padding: 2em;
				border-radius: 1em;
			}

			.card__front h2 {
				color: white;
				letter-spacing: 0.1em;
				line-height: 1.25em;
			}

			.card__back {
				background-color: #1b2a2f;
				transform: rotateY(180deg);
				padding: 2em;
				border-radius: 1em;
			}

			.card__back h2 {
				color: white;
				letter-spacing: 0.1em;
				line-height: 1.25em;
			}

			ul.colors {
				list-style-type: none;
				display: flex;
				flex-direction: row;
			}

			.color_selection {
				height: 25px;
				width: 25px;
			}
		</style>
	</head>

	<body class="landing is-preload">


		<header id="header">
			<a href="#menu">Menu</a>
			<a class="button" href="#createcards">Create New Cards</a>
			<a href="#" class="button" onclick="invertCards()">Invert Card Faces</a>
		</header>

		<nav id="menu">
			<h4 style="text-align: center">Your Cards</h4>
			<ul class="links" id="menusets">
				<li><a href="#">Home</a></li>
			</ul>
			<ul class="links stacked">
				<li><a href="#createcards" class="button fit primary small">Create new cards</a></li>
				<li><a href="index.php#cardsets" class="button fit primary small">Back to card sets</a></li>
				<li><a href="logout.php" class="button fit primary small">Log Out</a></li>
			</ul>

			<div style="display: flex; flex-direction: row; justify-content:space-around;">
				<h5>Color: </h5>
				<div style = "display:flex;flex-direction:colummn;">
					<ul class="colors">
						<li id="color1" class="color_selection" style="background-color:#000000"></li>
						<li id="color2" class="color_selection" style="background-color:#101415"></li>
						<li id="color3" class="color_selection" style="background-color:#172023"></li>
						<li id="color4" class="color_selection" style="background-color:#1b2a2f"></li>
						<li id="color5" class="color_selection" style="background-color:#4e6d78"></li>
						<li id="color6" class="color_selection" style="background-color:#75929e"></li>
						<li id="color7" class="color_selection" style="background-color:#80969f"></li>
						<li id="color8" class="color_selection" style="background-color:#95a5a6"></li>
					</ul>
				</div>
			</div>
		</nav>


		<br style="line-height: 3em;">
		<section id="banner" style="opacity: 95%">
			<header class="major" id="quiztitle">
				<h1>FlashCards</h1>
			</header>
		</section>

		<div id="flashcards" style="opacity: 90%;">



			<!-- <section class="wrapper style1 special alt" >
<div class="card">
<div class="inner card__inner" style="min-height: 30em">
<div class="card__front">
<h2>QUESTION HERE</h2>
</div>
<div class="card__back">
<h2>ANSWER HERE</h2>
</div>
</div>
</div>
</section> -->



		</div>

		<br style="line-height: 5em;">
		<section id="createcards" class="wrapper style4 special-alt" style="opacity: 90%">
			<div class="inner split">
				<section>
					<header class="major">
						<h2>New Cards</h2>
					</header>
					<p>Create new cards here by entering a card's answer and the description, definition, or question that it goes along with.</p>
				</section>
				<form method="post" action="#">
					<label for="name">Answer</label>
					<input type="text" id="quiz-question" name="name" required />
					<label for="desc">Description</label>
					<textarea name="desc" id="quiz-answer" rows="2" style="resize: none"></textarea>
					<ul class="actions">
						<li><a href="#cardsets" class="button" id="createBtn" type="submit">Create</a></li>
					</ul>
				</form>
			</div>
		</section>

		<section class="wrapper style1 special alt " style="opacity: 90%">
			<div class="inner">
				<ul class="actions special">
					<li><a class="button" id="logout" href="index.php#cardsets">Back to Card Sets</a></li>
					<li><a class="button" onclick="invertCards()" href="#">Invert Card Faces</a></li>
				</ul>
			</div>
		</section>


		<br style="line-height: 5em;">


		<script src="assets/js/jquery.min.js"></script>
		<script src="assets/js/jquery.scrolly.min.js"></script>
		<script src="assets/js/jquery.scrollex.min.js"></script>
		<script src="assets/js/browser.min.js"></script>
		<script src="assets/js/breakpoints.min.js"></script>
		<script src="assets/js/util.js"></script>
		<script src="assets/js/main.js"></script>

		<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


		<script>
			var quiz_id = <?php echo $quiz_id ?>;
			var user_id = <?php echo $user_id ?>;
			var is_inverted = false;

			loadTitle()
			Load(quiz_id);


			function invertCards() {
				is_inverted = !is_inverted;
				Load(quiz_id);
				//alert('Cards Inverted');
			}

			function loadTitle() {
				document.getElementById("quiztitle").innerHTML = "";
				$.ajax({
					url: "set-api/getquizname.php",
					type: "POST",
					data: {
						"quizid": quiz_id,
					},
					success: function(response) {
						response.forEach(function(quiz, index) {

							if (quiz.name == "") quiz.name = "No Title";
							if (quiz.description == "") quiz.description = "No Description";
							$('#quiztitle').append('<h1>' + quiz.name + '</h1><p>' + quiz.description + '</p')
						});

					}
				});
			}

			function Load(quiz_id) {
				document.getElementById("flashcards").innerHTML = "";
				document.getElementById("menusets").innerHTML = "";
				$.ajax({
					url: "set-api/listcard.php",
					type: "POST",
					data: {
						"quizid": quiz_id,
					},
					success: function(response) {
						response.forEach(function(flashcard, index) {
							if (!is_inverted) $('#flashcards').append('<section class="wrapper style1 special alt" id = "card' + flashcard.id + '"><div class="card"><div class="inner card__inner" style="min-height: 30em"><div class="card__front"><h2>' + flashcard.question + '</h2></div><div class="card__back"><h2>' + flashcard.answer + '</h2></div></div></div></section>');
							else $('#flashcards').append('<section class="wrapper style1 special alt" id = "card' + flashcard.id + '"><div class="card"><div class="inner card__inner" style="min-height: 30em"><div class="card__front"><h2>' + flashcard.answer + '</h2></div><div class="card__back"><h2>' + flashcard.question + '</h2></div></div></div></section>');

							$('#menusets').append(
								$('<li><a class="button small scrolly" href ="#card' + flashcard.id + '">' + flashcard.question + '</a></li>')
							);

						});

					}
				});
			}



			$(document).on('click', '#createBtn', function(e) {
				e.preventDefault();
				console.log($("#addcardform").serialize());
				$.ajax({
					url: "set-api/createcard.php",
					type: "POST",
					data: {
						"quiz_question": $('#quiz-question').val(),
						"quiz_answer": $('#quiz-answer').val(),
						"quizid": quiz_id,
					},
					success: function(response) {
						//console.log(response);
						if (response.code == '201') {
							//alert('Flashcard Created Successfully');
							Load(quiz_id);
							$("input[type=text], textarea").val("");
						} else {
							console.log('Error');
						}
					}
				});
			});
			$('#flashcards').on('click', '.card__inner', function() {
				$(this).toggleClass('is-flipped');
			});


			$("ul.colors li").on('click', function() {
				$('.colors li').css('border', '0px');
				$('.card__front').css('background-color', $('#' + this.id).css('background-color'));
				$('.card__back').css('background-color', $('#' + this.id).css('background-color'));
				$('#' + this.id).css('border', '3px solid black');
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