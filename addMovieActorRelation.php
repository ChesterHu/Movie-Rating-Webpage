<!-- This page is for adding Actor and Movie relations -->
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
<!-- connect to database -->
<?php
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");
?>

<body>
<!-- Navigation bar on the top  -->
<div id="navBar"></div>

<div class="container">
	<form method="post" action="<?php echo htmlspecialchars($_POST["PHP_SELF"]); ?>">
		<!-- Select list for the movie title -->
		<div class="form-group">
			<label for="movie">Select movie</label>
			<select calss="form-control" name="movie" id="movie">
			<!-- Display all movie titles in the select list, let value equal to the movie id -->
			<?php
				$query = "SELECT title, year, id FROM Movie ORDER BY title ASC";
				$movieTable = mysqli_query($db_connection, $query);
				while ($row = mysqli_fetch_row($movieTable))
					echo '<option value="' . $row[2] . '">' . $row[0] . "(" . $row[1] . ")" . "</option>";
			?>
			</select>
		</div>

		<!-- Select list for the actor name -->
		<div class="form-group">
			<label for="actor">Select actor</label>
			<select calss="form-control" name="actor" id="actor">
			<!-- Display all actor names in the select list, let value equal to the movie id -->
			<?php
				$query = "SELECT concat(first,' ', last), dob, id FROM Actor ORDER BY first ASC";
				$actorTable = mysqli_query($db_connection, $query);
				while ($row = mysqli_fetch_row($actorTable))
					echo '<option value="' . $row[2] . '">'. $row[0] . "(" . $row[1] . ")" . "</option>";
			?>
			</select>
		</div>

		<!-- Text area for role discription -->
		<div class="form-group">
			<label for="role">Actor role in Movie:</label>
			<textarea class="form-control" rows="5" name="role" id="actor"></textarea>
		</div>

		<!-- Input button -->
		<button type="submit" class="btn btn-warning">Submit</button>
		</div>
	</form>
</div>

<!-- Test -->
<?php
// out put the id of movie and actor
$vars = explode(" ", "movie actor role");
foreach ($vars as $var)
	echo $_POST[$var] . "</br>";
?>
</body>
</html>
