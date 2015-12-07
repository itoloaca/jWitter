<?php
session_start();
$password = $_POST['password'];
if (strlen($password) < 5) {
	$_SESSION["status_failure"] = "The password you entered was too short";
	header("Location: registration.php");
	exit('The password was invalid. Better luck next time.');
}
$password_hash = sha1($_POST['password']);
$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
	$_SESSION["status_failure"] = "Cannot connect to database";
	header("Location: registration.php");
	exit('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);


$sql = "INSERT INTO User (name, email, password_hash)
VALUES ('$_POST[name]','$_POST[email]', '$password_hash')";

if (!mysql_query($sql, $con)) {
	$_SESSION["status_failure"] = "Some of the data you entered was invalid";
	header("Location: registration.php");
	exit('Error: ' . mysql_error());
}

mysql_close($con);

echo "SUCCESS";
$_SESSION["status_success"] = "Registration successful";
$_SESSION['0xDEADBEEF'] = $_POST['email'];
header("Location: index.php");

exit();

?>
