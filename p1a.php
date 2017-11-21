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
</head>
<body>
<!-- Navigation bar on the top -->
<div id="navBar"></div>
<style>
.error {color: #FF0000;}
</style>



<body>
<div class="container">
	<h1>This is My Database Project1 Test</h1>
	<p>Enter your query in the following block</p>
	<?php
	$query = "";
	$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
	mysqli_select_db($db_connection, "TEST");
	?>
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<!-- Textarea for query input -->
		<div class="form-group">
			<label for="query"> Query: </label>
			<textarea class="form-control" name="query" id="query" rows="5" cols="40"></textarea>
		</div>
		<br>
		<!-- Submit button -->
		<button type="submit" class="btn btn-warning">Submit</button>
	</form>

<?php
if (!empty($_POST["query"]))
{
	$query = $_POST["query"];
	$tbl=mysqli_query($db_connection, $query);
	while ($row = mysqli_fetch_row($tbl))
	{
		for ($i = 0; $i < count($row); $i++)
			echo $row[$i] . " "; 
		echo "<br><br>";
	}
} 
else {
	echo "";
}

mysqli_close($db_connection);
?>
</div>
</body>
</html>
