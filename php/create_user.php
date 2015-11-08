<html>
<body>
<?php

$password = $_POST['password'];
if (strlen($password) < 5) {
	die('The password was invalid. Better luck next time.');
}
$password_hash = sha1($_POST['password']);
$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$sql = "INSERT INTO User (name, email, password_hash)
VALUES ('$_POST[name]','$_POST[email]', '$password_hash')";
 
if (!mysql_query($sql, $con)) {
  die('Error: ' . mysql_error());
}
echo "1 user added";
 
mysql_close($con);
?>
</body>
</html>
