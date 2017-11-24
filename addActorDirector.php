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
$insertResult = "";
// Check non-empty input
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	do
	{
		  // First name input should be non-emtpy
		if (empty($_POST["firstName"]))
		{
			$firstNameError = "First name is required!";
			break;
		}
		else
			$firstName = valid_input($_POST["firstName"]);
		  // Last name input should be non-empty
		if (empty($_POST["lastName"]))
		{
			$lastNameError = "Last name is required!";
			break;
		}
		else
			$lastName = valid_input($_POST["lastName"]);
		  // Date of birth input should be non-empty
		if (empty($_POST["dob"]))
		{
			$dobError = "Date of birth is required!";
			break;
		}
		else
		{
			  // Check the input format of dob
			$dt_dob = DateTime::createFromFormat("Y/m/d", $_POST["dob"]);
			if ($dt_dob === false || array_sum($dt_dob->getLastErrors()))
			{
				$dobError = "Please use the format of YYYY/MM/DD";
				break;
			}
			$dob = valid_input($_POST["dob"]);
		}

		  // Check input format of dod if it's not empty.
		if (!empty($_POST["dod"]))
		{
			$dt_dod = DateTime::createFromFormat("Y/m/d", $_POST["dod"]);
			if ($dt_dod === false || array_sum($dt_dod->getLastErrors()))  // array_sum() is to prevent php do month shifting (i.e jan 32 -> Feb 1)
			{
				$dodError = "Please use the format of YYYY/MM/DD";
				break;
			}
		}
		
		  // All input is valid if not break
		$identity = $_POST["identity"];
		$gender = $_POST["gender"];
		$dod = $_POST["dod"];
		  // Connect to the database
		$db_connection = mysqli_connect("localhost", "root", "Shuaibaobao521!");
		mysqli_select_db($db_connection, "TEST");
		  // Get Id for new person
		$personID = getId("Person", $db_connection) + 1;
		  // update maxPersonID
		mysqli_query($db_connection, "UPDATE MaxPersonID SET id = id + 1");
		$vars = array($personID, "'$lastName'", "'$firstName'", "'$gender'", "'$dob'", "'$dod'");
		  // Insert date into database
		if (insertTuple("Actor", $vars, $db_connection))
		{
			$insertResult = "Insertion succeeded";
			  // update maxPersonID
		}
		else
			$insertResult = "<span class = 'error'> Insertion failed! </span>";
	} while (false);
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
			<label><input type="radio" name="identity" value="Actor" checked>Actor/Actress</label>
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
			<label><input type="radio" name="gender" value="female" checked> Female</label>
		</div>
		<div class="radio-inline">
			<label><input type="radio" name="gender" value="male"> Male</label>
		</div><br>
		<div class="form-group">
			<label for="dob">Date of birth
				<span class="error">* <?php echo $dobError; ?></span>
			</label>
			<input type="text" class="form-control" placeholder="YYYY/MM/DD" name="dob" id="dob">
		</div>
		<div class="form-group">
			<label for="dod">Date of death
				<span class="error"><?php echo $dodError; ?></span>
			</label>
			<input type="text" class="form-control" placeholder="YYYY/MM/DD" name="dod" id="dod">
			(Leave blank if alive)
		</div>
		<br>
		<!-- Input button -->
		<button type="submit" class="btn btn-warning">Submit</button>
		<br>
		<!-- Result of Insertion -->
		<?php echo $insertResult; ?>
	</form>
</div>
</body>
</html>
