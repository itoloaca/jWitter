<?php
session_start();
include('../bootstrap/config.php');

if (strlen($_POST['content']) > 140) {
	$_SESSION['status_failure'] = 'The content was invalid. Better luck next time.';
		header('Location: ../index.php');
	exit();
}
if (strlen($_POST['content']) < 3) {
	$_SESSION['status_failure'] = 'The content was invalid. Better luck next time.';
	header('Location: ../index.php');
	exit();
}

$con = mysql_connect("localhost:3306","dbwa_sparta", $db_pass);
if (!$con) {
	$_SESSION['status_failure'] = 'Could not connect: ' . mysql_error();

	header('Location: ../index.php');
	exit();

}

mysql_select_db("dbwa_sparta", $con);


$sql = "INSERT INTO Post (content, authorId)
VALUES ('$_POST[content]','$_POST[authorId]')";

if (!mysql_query($sql, $con)) {
	$_SESSION['status_failure'] = 'Error: ' . mysql_error();

	header('Location: ../index.php');
	exit();

}

mysql_close($con);

$_SESSION['status_success'] = "1 post added";

header('Location: ../index.php');
exit();

?>
