<html>
<body>
<?php

if (strlen($_POST['content']) > 140) {
	die('The content was invalid. Better luck next time.');
}
if (strlen($_POST['content']) < 3) {
	die('The content was invalid. Better luck next time.');
}
echo $password;
echo $password_hash;
$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$sql = "INSERT INTO Post (content, authorId)
VALUES ('$_POST[content]','$_POST[authorId]')";
 
if (!mysql_query($sql, $con)) {
  die('Error: ' . mysql_error());
}
echo "1 post added";
 
mysql_close($con);
?>
</body>
</html>