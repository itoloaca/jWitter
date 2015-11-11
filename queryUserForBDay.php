<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php

$PREVIEW_LENGTH = 10;

$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$bdayOriginal = $_POST['bday'];
$bday = $_POST['bday'];
$bday = date('Y-m-d', 
  strtotime(str_replace('-', '/',$bday)));
$sql = "SELECT U.name, U.email, P.name
from User U
inner join Preferences P on U.userId = P.userId
where P.birthdate = '$bday'";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
echo "<h2>Users with birthday on $bdayOriginal </h2>";
if (mysql_num_rows($result) == 0) {
	echo "<h5 style='color: red;'>No results found!</h5>";
	die();
}
echo "<ol class='users'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$preview = $row[0] . "...";
  $userName = urlencode($row[0]);
  $bday = urlencode($bdayOriginal);
  $email = urlencode($row[1]);
  $prefName = urlencode($row[2]);
	$href = "detailUserForBDay.php?" .
			"userName=$userName&" . 
			"bday=$bday&" .
      "email=$email&" .
      "prefName=$prefName";
    echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
