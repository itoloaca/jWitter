<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php

$PREVIEW_LENGTH = 10;

$email = $_POST['email'];


$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$sql = "SELECT UFollower.name, UFollower.email
from User UFollowed
inner join FollowerFollowed F on UFollowed.userId = F.followedId
inner join User UFollower on F.followerId = UFollower.userId 
where UFollowed.email = '$email'";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
if (mysql_num_rows($result) == 0) {
    echo "<h5 style='color: red;'>No results found!</h5>";
    die();
}

echo "<h2>Followers of user with email $email</h2>";

echo "<ol class='qresults'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
    $preview = $row[0];
    $name = urlencode($row[0]);
    $femail = urlencode($row[1]);
    $email_enc = urlencode($email);

    $href = "detailFollowerNames.php?".
            "name=$name&".
            "femail=$femail&".
            "email=$email_enc";
    echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
