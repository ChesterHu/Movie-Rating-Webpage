<!-- This page is for adding actor/director to database -->
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
<!-- Navigation bar on the top  -->
<div id="navBar"></div>

<!-- Form for Actor/Director data input -->
<div class="container">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
		<!-- Radio button for Actor/Director -->
		<div class="radio-inline">
			<label><input type="radio" name="role" value="Actor">Actor</label>
		</div>
		<div class="radio-inline">
			<label><input type="radio" name="role" value="Director">Director</label>
		</div>
		
		<!-- Text input for last name and first name -->
		<div class="form-group">
			<label for="lastName">Last Name:</label>	
			<input type="text" class="form-control" name="lastName" id="lastName">
		</div>
		<div class="form-group">
			<label for="firstName">First Name:</label>
			<input type="text" class="form-control" name="firstName" id="firstName">
		</div>
		<!-- Radio button for female/male -->
		<div class="radio-inline">
			<label><input type="radio" name="gender" value="female"> Female
		</div>
		<div class="radio-inline">
			<label><input type="radio" name="gender" value="male"> Male
		</div><br>
		<div class="form-group">
			<label for="dob">Date of birth</label>
			<input type="text" class="form-control" placeholder="YYYY/MM/DD" name="dob" id="dob">
		</div>
		<div class="form-group">
			<label for="dod">Date of death</label>
			<input type="text" class="form-control" placeholder="YYYY/MM/DD" name="dod" id="dod">
			(Leave blank if alive)
		</div>
		<br>
		<!-- Input button -->
		<button type="submit" class="btn btn-warning">Submit</button>
		</div>
	</form>
</div>
</body>

<!-- Test -->
<?php
echo $_POST["role"] . "<br>";
echo $_POST["lastName"] . "<br>";
echo $_POST["firstName"] . "<br>";
echo $_POST["gender"] . "<br>";
echo $_POST["dob"] . "<br>";
echo $_POST["dod"] . "<br>";
?>
</html>
