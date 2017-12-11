<!-- This page is for adding comments to a movie -->
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
	.error {color : #FF0000;}
	</style>
</head>

<!-- connect to database -->
<?php
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");

$movieID = 4759;
$movieName = "test";
?>

<!-- Input validation -->
<?php
include "utilities.php";
$userName = $comments = $rating = "";
$userNameError = $commentsError = "";

  // Check non-empty input
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	do
	{
		  // User name input should be non-empty
		$userName = valid_input($_POST["userName"]);
		if (empty($userName))
		{
			$userNameError = "User name is required!";
			break;
		}
		  // Comment input should be non-empty
		$comments = $_POST["comments"];
		if (empty($comments))
		{
			$commentsError = "Comments is required!";
			break;
		}

		$rating = $_POST["rating"];
		echo $userName;
		echo $comments;
		echo $rating;
		echo date("Y-m-d H:i:s");
	} while (false);
}

?>


<!-- comments form -->
<body>
<!-- Navigation bar on the top -->
<div id="navBar"></div>

<div class="container">
	<h1>Add your comment on "<?php echo $movieName ?></h1>
	<p><span class="error">* required field</span><p>
	<br>
	<form method="post" action="<?php echo htmlspecialchars($_POST["PHP_SELF"]); ?>">

		<!-- text input for comment -->
		<div class="form-group">
			<label for="userName">User name
				<span class="error">* <?php echo $userNameError; ?></span>
			</label>
			<input type="text" class="form-control" name="userName" id="userName">
		</div>

		<!-- User name -->
		<div class="form-group">
			<label for="comments">Comment
				<span class="error">* <?php echo $commentsError; ?></span>
			</label>
			<textarea class="form-control" rows="5" name = "comments" id="comments"></textarea>
		</div>
		
		<!-- select list for rating 1-5 -->
		<div class="form-group">
			<label for="rating">Rating</label>
			<select class="form-control" id="rating" name="rating">
				<option selected>1</option>
				<option>2</option>
				<option>3</option>
				<option>4</option>
				<option>5</option>
			</select>	
		</div>
		
		<!-- Submit button -->
		<button type="submit" class="btn btn-warning">Submit</button>
		<br>

		<!-- Insert result -->
		<?php echo $insertResult; ?>	
	</form>
</div>

<?php

?>

</body>

</html>
