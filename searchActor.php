<!--This is an page implementation that shows actor information and links to the movie that the actor was in as well.-->
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Movie Ratings </title>
	<meta charset="utf-8">
	<!-- for mobile usage, ensure proper rendering and touch zooming -->
	<meta name = "viewport" content = "width=device-width, initial-scale=1">
	<!-- bootstrap -->
	<link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"rel = "stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<!-- include navBar.html -->
	<script src="jquery.js"></script>
	<script>$(function(){$("#navBar").load("navBar.html");});</script>
</head>

<body>
<!-- Navigation bar on the top -->
<div id="navBar"></div>

<!-- Searching interface -->
<div class="container">
	<!-- input area and search submit button -->
	<form method="post" action="<?php echo htmlspecialchars($_POST["PHP_SELF"]); ?>">
		<div class="form-group">
			<label for="name">Searching Actor and Movie:</label>
			<input type = "text" class="form-control" name="name" autocomplete="off">
		</div>
		<button type="submit" class="btn btn-default">
		<span class="glyphicon glyphicon-search"></span>
		</button>
	</form>

	<!-- Connect database and define input -->
	<?php
	$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
	mysqli_select_db($db_connection, "TEST");
	?>
	<!-- If there is input name, do query in the database and print table of matching actors and matcing movies -->
	<?php
	if (!empty($_POST["name"]))
	{
		include 'utilities.php';
		$names = explode(" ", $_POST["name"]);
		$actor_tbl = querySearch($names, "Actor", "concat(last, ' ', first)", "concat(last, ' ', first), dob", $db_connection);
		$movie_tbl = querySearch($names, "Movie", "title", "title, year", $db_connection);
		printTable($actor_tbl, "Matching Actors", array("Name", "Date of birth"));
		printTable($movie_tbl, "Matching Movies", array("Titile", "Release year"));

	}
	mysqli_close($db_connection);
?>
</div>
</body>

</html>
