<!DOCTYPE html>
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>


<body>
<?php

function foo($name)
{
	echo $name . "<br>";
}

foreach ($_SERVER as $x => $x_val)
{
	echo "$x : $x_val<br>";
}
?>

<form method = "post" action = "<?php echo $_SERVER["PHP_SELF"]; ?>">
	Name : <input type = "text" name = "m_input"><br>
	<input type = "submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$name = $_REQUEST["m_input"];
	if (empty($name))
		echo "Name is empty.<br>";
	else
		echo "$name <br>";
}
?>

</body>

</html>
