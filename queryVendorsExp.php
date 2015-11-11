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


$mindads = $_POST['minads'];
$sql = "SELECT Tmp.vendor
    from (select A.vendor as vendor, AVG(A.exposures) as avgexp
          from Ad A
              group by A.vendor
                  having COUNT(*) >= '$minads') Tmp
                  where Tmp.avgexp > (select AVG(A1.exposures) from Ad A1);";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
echo "<h2>Vendors with above average exposures and more than $minads ads</h2>";
if (mysql_num_rows($result) == 0) {
	echo "<h5 style='color: red;'>No results found!</h5>";
	die();
}
echo "<ol class='posts'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $vendor = urlencode($row[0]);
	$preview = $row[0] . "...";

	$href = "detailVendorsExp.php?" .
			"vendor=$vendor&" . 
			"minads=$minads";
    echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
