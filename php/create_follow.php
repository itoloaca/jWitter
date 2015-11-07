<html>
<body>
<?php

if ($_POST[followerId] == $_POST[followedId]) {
	die("A user cannot follow himself. Usually.");
}


$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


/* UGLY HACK; gonna hate myself in the morning */
$sql_follower = "SELECT * FROM User U WHERE U.userId = '$_POST[followerId]'";
$sql_followed = "SELECT * FROM User U WHERE U.userId = '$_POST[followedId]'";
$res_follower = mysql_query($sql_follower, $con);
$res_followed = mysql_query($sql_followed, $con);

if (mysql_num_rows($res_follower) == 0) {
	die("Invalid follower id");
}

if (mysql_num_rows($res_followed) == 0) {
	die("Invalid followed id");
}

$sql = "INSERT INTO FollowerFollowed (followerId, followedId)
VALUES ('$_POST[followerId]','$_POST[followedId]')";
 
if (!mysql_query($sql, $con)) {
  die('Error: ' . mysql_error());
}
echo "1 follow relationship added";
 
mysql_close($con);
?>
</body>
</html>