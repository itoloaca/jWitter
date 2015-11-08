<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php

$PREVIEW_LENGTH = 10;

$daysago = $_POST['daysago'];

$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$sql = "SELECT U.name, P.content from User U
	inner join Post P on  U.userId = P.authorId
	where P.created_at 
	BETWEEN DATE_SUB(NOW(), INTERVAL '$daysago' DAY) AND NOW();";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
echo "<h2>Post more recent than $daysago days</h2>";
if (mysql_num_rows($result) == 0) {
	echo "<h5 style='color: red;'>No results found!</h5>";
	die();
}
echo "<ol class='qresults'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	
	$preview = $row[0] . "...";
	$author = urlencode($row[0]);
	$content = urlencode($row[1]);


	$href = "detailRecentAuthors.php?".
			"content=$content&".
			"author=$author&".
			"daysago=$daysago";
    echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
