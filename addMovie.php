<!-- This page is for adding movie to database -->
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
	<style>
	.error {color: #FF0000;}
	</style>
</head>
<!-- Get input -->
<?php
include "utilities.php";

  // Declare variables
$title = $year = $rating = $company = "";
$genre_input = array();

  // Declare error messages:
$titleError = $companyError = $genreError = "";

  // Check if it's non empty and assign value to variables
  // Check customer title input
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	if (empty($_POST["title"]))
		$titleError = "Title is required!";
	else
		$title = valid_input($_POST["title"]);

	  // Check customer year input
	if (empty($_POST["company"]))
		$companyError = "Company name is required!";
	else
		$year = valid_input($_POST["company"]);

	  // Check movie genres
	if (empty($_POST["genres"]))
		$genreError = "At least one genre should be chosen!";
}
/*
$vars = explode(" ", "title year rating company");
foreach ($vars as $var)
	echo $_POST[$var]. "<br>";
if (isset($_POST['genres']))
	foreach ($_POST['genres'] as $i)
		echo $i . "<br>";
else
	echo "";
 */
?>

<body>
<!-- Navigation bar on the top -->
<div id="navBar"></div>
<!-- Form for movie data input -->
<div class="container">
	<!-- Error display if empty input for required fields -->
	<p><span class="error">* required field </span></p>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		
		<!-- Text input for movie's title-->
		<div class="form-group">
			<label for="title">Title
				<span class="error">* <?php echo $titleError; ?></span>
			</label>
			<input type="text" class="form-control" name="title" id="title">
		</div>
		
		<!-- Select list for movie's distribution year -->
		<div class="form-group">
			<label for="year">Year:</label>
			<select class="form-control" name="year" id="year">
			<?php
				for ($i = 1890; $i < date("Y"); $i++)
					echo "<option>$i</option>";
			?>
			</select>
		</div>
		
		<!-- Select list for movie's MPAA rating -->
		<div class="form-group">
			<label for="rating">MPAA Rating:</label>
			<select class="form-control" name="rating" id="year">
			<?php
				$Ratings = explode(" ", "PG-13 R RG NC-17 G surrendere");
				foreach ($Ratings as $r)
					echo "<option>$r</option>";
			?>
			</select>
		</div>
		
		<!-- Text input for movie's production company -->
		<div class="group-format">
			<label for="company">Production Company
				<span class="error">* <?php echo $companyError; ?></span>
			</label>
			<input class="form-control" name="company" id="company">
		</div>
		<br>

		<!-- Check box for movie genre -->
		<div class="form-group">
			<label>Genres
				<span class="error">*</span>
			</label>
			<?php
				  // All possible movie genre
				$genresTable = explode(",", "Action,Adult,Adventure,Animation,Comedy,Crime,Documentary,Drama,Family,Fantasy,Horror,Musical,Mystery,Romance,Sci-Fi,Short,Thriller,War,Western");
					// Store selected genre in an array
				foreach($genresTable as $g)
				{
					echo "<label class='checkbox-inline'>";
					echo "<input type='checkbox' name='genres[]' value='" . $g;
					echo "'>" . $g . "</input></label>";
				}
			?>
			<label>
				<span class="error"><?php echo $genreError; ?></span>
			</label>
		</div>
		<br>
		
		<!-- Input button -->
		<button type="submit" class="btn btn-warning">Submit</button>
	</form>
</div>

</body>
</html>
