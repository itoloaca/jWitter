<?php
session_start();
$password = $_POST['password'];
if (strlen($password) < 5) {
	$_SESSION["status_failure"] = "The password you entered was too short";
	header("Location: index.php");
	exit('The password was invalid. Better luck next time.');
}
$password_hash = sha1($_POST['password']);
$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
	$_SESSION["status_failure"] = "Cannot connect to database";
	header("Location: index.php");
	exit('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);


$sql = "SELECT * FROM User U WHERE 
U.name = '$_POST[name]' and 
U.email ='$_POST[email]' and 
U.password_hash = '$password_hash'";

$result = mysql_query($sql, $con);
if (!$result) {
	$_SESSION["status_failure"] = "Cannot connect to database";
	header("Location: signin.php");
	exit();
}
 

if (mysql_num_rows($result) == 0) {
	echo "<h5 style='color: red;'>No results found!</h5>";
	$_SESSION["status_failure"] = "Invalid account";
	header("Location: signin.php");
	exit();
}
if (!mysql_query($sql, $con)) {
	$_SESSION["status_failure"] = "Some of the data you entered was invalid";
	header("Location: index.php");
	exit('Error: ' . mysql_error());
}

echo "SUCCESS";
$_SESSION["status_success"] = "Registration successful";


mysql_close($con);
header("Location: signin.php");

exit();

?>
