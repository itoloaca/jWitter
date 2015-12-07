<?php
session_start();
include('bootstrap/config.php');

$password = $_POST['password'];
$password_hash = sha1($_POST['password']);

$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
	$_SESSION["status_failure"] = "Cannot connect to database";
	header("Location: signin.php");
	exit('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);


$sql = "SELECT * FROM User U WHERE 
U.email ='$_POST[email]' AND 
U.password_hash = '$password_hash'";

$result = mysql_query($sql, $con);
if (!$result) {
	$_SESSION["status_failure"] = "Cannot connect to database";
	header("Location: signin.php");
	exit();
}
 
if (mysql_num_rows($result) == 0) {
	echo "<h5 style='color: red;'>No results found!</h5>";
	$_SESSION["status_failure"] = "Invalid credentials :(";
	header("Location: signin.php");
	exit();
}
mysql_close($con);

echo "SUCCESS";
$email = $_POST['email'];
$_SESSION["0xDEADBEEF"] = $email;

$_SESSION["status_success"] = "Signin successful";
header("Location: index.php");
exit();

?>
