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
  // get movie ratings
$ratingTbl = mysqli_query($db_connection, "SELECT imdb, rot FROM MovieRating WHERE mid = $movieID");
  // get actors in the movie
$movieActorTbl = mysqli_query($db_connection, "SELECT CONCAT(first,' ', last), CONCAT('\"',role,'\"'), sex, dob, dod,  Actor.id from Actor, Movie, MovieActor WHERE Movie.id = $movieID AND Movie.id = mid AND Actor.id = aid order by first asc");

  // close data base connection
mysqli_close($db_connection);

  // fetch genres
$genres = "";
while ($row = mysqli_fetch_row($genreTbl))
	$genres .= $row[0] . ', ';
$genres = substr($genres, 0, -2);
  // fetch director name
$director = mysqli_fetch_row($directorTbl)[0];
  // fetch movie informations
$vars = mysqli_fetch_row($movieTbl);
$title = $vars[0]; $year = $vars[1]; $company = $vars[2]; $rating = $vars[3];
  // fetch movie ratings
$ratings = mysqli_fetch_row($ratingTbl);
?>


<!-- Movie information table -->
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


<!-- Actors in this movie table -->
<?php

  // print actor information table
$col_name = array("Name","Role in the movie", "Gender", "Date of birth", "Date of death");
printTable($movieActorTbl, "Actors in this movie:", $col_name, "showActor.php");

?>

<!-- Movie ratings table -->
<div class='container'>
	<h2>Movie Ratings: </h2>
	<table class='table table-bordered'>
		<thead>
			<tr>
				<th>IMDb</th>
				<th>Rotten Tomatoes</th>
				<th>User Review</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td><?php echo empty($ratings) ? '-' : $ratings[0] . '/100'; ?></td>
				<td><?php echo empty($ratings) ? '-' : $ratings[1] . '/100'; ?></td>
				<td><?php echo empty($userRating) ? '-' : $userRating . '/10'; ?></td>
			</tr>
		</tbody>		
	</table>
</div>

</body>
</html>
