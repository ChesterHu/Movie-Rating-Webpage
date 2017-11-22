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
	<style>
	.error {color: #FF0000; }
	</style>
</head>

<!-- Get input or generate error message -->
<?php
include "utilities.php";
  // Delcare input and error variables
$identity = $lastName = $firstName = $gender = $dob = $dod = "";
$identityError = $lastNameError = $firstNameError = $genderError = $dobError = $dodError = "";
// Check non-empty input
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	  // First name input should be non-emtpy
	if (empty($_POST["firstName"]))
		$firstNameError = "First name is required!";
	else
		$firstName = valid_input($_POST["firstName"]);
	  // Last name input should be non-empty
	if (empty($_POST["lastName"]))
		$lastNameError = "Last name is required!";
	else
		$lastName = valid_input($_POST["lastName"]);
	  // Date of birth input should be non-empty
	if (empty($_POST["dob"]))
		$dobError = "Date of birth is required!";
	else
		$dob = valid_input($_POST["dob"]);

	$identity = $_POST["identity"];
	$gender = $_POST["gender"];
	$dod = $_POST["dod"];
}
?>

<body>
<!-- Navigation bar on the top  -->
<div id="navBar"></div>

<!-- Form for Actor/Director data input -->
<div class="container">
	<p><span class="error">* required field</span></p>
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
		
		<!-- Radio button for Actor/Director -->
		<div class="radio-inline">
			<label><input type="radio" name="identity" value="Actor">Actor</label>
		</div>
		<div class="radio-inline">
			<label><input type="radio" name="identity" value="Director">Director</label>
		</div>
		
		<!-- Text input for first name and last name -->
		<div class="form-group">
			<label for="firstName">First Name
				<span class="error">* <?php echo $firstNameError; ?></span>
			</label>
			<input type="text" class="form-control" name="firstName" id="firstName">
		</div>
		<div class="form-group">
			<label for="lastName">Last Name
				<span class="error">* <?php echo $lastNameError; ?></span>
			</label>
			<input type="text" class="form-control" name="lastName" id="lastName">
		</div>
		
		<!-- Radio button for female/male -->
		<div class="radio-inline">
			<label><input type="radio" name="gender" value="female"> Female
		</div>
		<div class="radio-inline">
			<label><input type="radio" name="gender" value="male"> Male
		</div><br>
		<div class="form-group">
			<label for="dob">Date of birth
			<span class="error">* <?php echo $dobError; ?></span>
			</label>
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
echo $_POST["identity"] . "<br>";
echo $_POST["lastName"] . "<br>";
echo $_POST["firstName"] . "<br>";
echo $_POST["gender"] . "<br>";
echo $_POST["dob"] . "<br>";
echo $_POST["dod"] . "<br>";
$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
mysqli_select_db($db_connection, "TEST");
echo getId("Person", $db_connection);
?>
</html>
