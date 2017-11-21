<html>
<body>
<?php
// define variable that could be submitted to the server
$name = $email = $gender = $comment = $website = "";
$vars = array("name"=>"", "email"=>"", "gender"=>"", "comment"=>"", "website"=>"");

if ($_SERVER["REQUEST_METHOD"] = "POST")
{
	foreach($vars as $x => $x_value)
	{
		$x = test_input($x_value);
	}
}

// function to remove extra characters
function test_input($data)
{
	return trim(stripslashes(htmlspecialchars($data)));
}

?>
</body>
</html>
