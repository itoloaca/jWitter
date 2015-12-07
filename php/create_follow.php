<?php
include('php/header.php');
?>
<?php
if ($_POST["followerId"] == $_POST["followedId"]) {
	die("A user cannot follow himself. Usually.");
}

$delete = $_POST["delete"];

$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);

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

if ($delete == "1") {
	$sql = "DELETE FROM FollowerFollowed 
	WHERE followerId='$_POST[followerId]' 
	AND followedId='$_POST[followedId]'";
}
 
if (!mysql_query($sql, $con)) {
  die('Error: ' . mysql_error());
}
if ($delete == "0") {
	echo "1 follow relationship added";
} else if ($delete == "1") {
	echo "1 follow relationship destroyed";
}

mysql_close($con);

if ($_POST['followedEmail'] !== NULL) {
	$email = $_POST['followedEmail'];
	header("Location: ../profile.php?email=" . urlencode($email));
} else {
	header("Location: ../input_form_maintenance.php");
}
 
 exit();
?>
<?php
include('php/footer.php');
?>
