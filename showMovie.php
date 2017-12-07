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
  // get movie id from GET method
$movieID = $_GET["ID"];
  // create connection to data base
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");

  // get movie information table
$movieTbl = mysqli_query($db_connection, "SELECT title, year, company, rating FROM Movie  WHERE id = $movieID");
  // get movie genres
$genreTbl = mysqli_query($db_connection, "SELECT genre FROM Movie m, MovieGenre mg WHERE m.id = $movieID AND mg.mid = m.id");
  // get movie's director, might be empty
$directorTbl = mysqli_query($db_connection, "SELECT CONCAT(first, ' ', last) FROM Director, MovieDirector WHERE mid = $movieID AND id = did");

  // fetch variables from movie information table, director table and genre table
$genres = "";
while ($row = mysqli_fetch_row($genreTbl))
	$genres .= $row[0] . ',';
$genres = substr($genres, 0, -1);
$director = mysqli_fetch_row($directorTbl)[0];
$vars = mysqli_fetch_row($movieTbl);
$title = $vars[0]; $year = $vars[1]; $company = $vars[2]; $rating = $vars[3];

?>


<!-- Movie information -->
<div class='container'>
	<h2>Movie Information: </h2>
	<table class='table table-striped'>
		<tbody>
			<tr>
				<th>Title </th> <td><?php echo $title . '(' . $year . ')'; ?> </td>
			</tr>
			<tr>
				<th>Producer </th> <td><?php echo $company; ?> </td>
			</tr>
			<tr>
				<th>MPAA Rating </th> <td><?php echo $rating; ?> </td>
			</tr>
			<tr>
				<th>Director </th> <td><?php echo empty($director) ? '-' : $director; ?> </td>
			</tr> 
			<tr>
				<th>Genre(s) </th> <td><?php echo empty($genres) ? '-' : $genres; ?> </td>
			</tr> 
		</tbody>
	</table>
</div>


<?php

  // print actor information table
$movieActorTbl = mysqli_query($db_connection, "SELECT CONCAT(first,' ', last), CONCAT('\"',role,'\"'), sex, dob, dod,  Actor.id from Actor, Movie, MovieActor WHERE Movie.id = $movieID AND Movie.id = mid AND Actor.id = aid order by first asc");
$col_name = array("Name","Role in the movie", "Gender", "Date of birth", "Date of death");
printTable($movieActorTbl, "Actors in this movie:", $col_name, "showActor.php");
  // close data base connection
mysqli_close($db_connection);

?>


</body>
</html>
