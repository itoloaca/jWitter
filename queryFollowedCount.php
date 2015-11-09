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


$sql = "SELECT COUNT(*)
    from User UFollower
    inner join FollowerFollowed F on UFollower.userId = F.followerId
    inner join User UFollowed on F.followedId = UFollowed.userId 
    where UFollower.email = '$email';";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
echo "<h2>Count of users followed by user with email $email</h2>";
if (mysql_num_rows($result) == 0) {
    echo "<h5 style='color: red;'>Zero results found!</h5>";
    die();
} 
$row = mysql_fetch_array($result, MYSQL_NUM);
$preview = $row[0];
$email = urlencode($email);

$href = "detailFollowedCount.php?".
        "count=$preview&".
        "email=$email";
echo "<h1><a href='$href'>$preview</a></h1>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
