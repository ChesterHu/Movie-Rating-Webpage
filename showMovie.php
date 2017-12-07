<!-- An implementation for printing Movie information table -->
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
include "utilities.php";
  // create connection to data base
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");

  // search actor by actor id
$movieID = $_GET["ID"];

  // print actor information table
$movieActorTbl = mysqli_query($db_connection, "SELECT last, first, sex, dob, dod from Actor, Movie, MovieActor WHERE Movie.id = $movieID AND Movie.id = mid AND Actor.id = aid order by last asc");
$col_name = array("Last name", "First name", "Gender", "Date of birth", "Date of death");
printTable($movieActorTbl, "Actors in this movie:", $col_name);
  // close data base connection
mysqli_close($db_connection);
?>
</body>
</html>
