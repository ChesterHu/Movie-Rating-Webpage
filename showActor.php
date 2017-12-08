<!-- This page is an implementation that shows actor inofrmation the movie the actor was in -->
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

<?php
  // create connection to data base
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");

  // search actor by actor id
$actorID = $_GET["ID"];

  // print actor information table
$tbl = mysqli_query($db_connection, "SELECT last, first, sex, dob, dod FROM Actor WHERE id = $actorID");
include "utilities.php";
$col_name = array("Last name", "First name", "Gender", "Date of birth", "Date of death");
printTable($tbl, "Actor Information:", $col_name);

  // print movies that the actor was in
$tbl = mysqli_query($db_connection, "SELECT title, CONCAT('\"', role, '\"'), year, Movie.id FROM Actor, Movie, MovieActor WHERE Actor.id = aid AND Movie.id = mid AND aid = $actorID ORDER BY year DESC");
$col_name = array("Movie title","Role", "Year");
printTable($tbl, "Movies the actor was in:", $col_name, "showMovie.php");

  // close data base connection
mysqli_close($db_connection);
?>
</body>
</html>
