<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php

$PREVIEW_LENGTH = 10;

$email = $_POST['email'];
if (strlen($email) < 4) {
    die('The email was invalid. Better luck next time.');
}
$con = mysql_connect("localhost:3306","dbwa_sparta","foobar33");
if (!$con) {
  die('Could not connect: ' . mysql_error());
}
 
mysql_select_db("dbwa_sparta", $con);


$sql = "SELECT P.content, P.postId, P.created_at FROM User U
						INNER JOIN Post P on U.userId = P.authorId
						where U.email='$email'";

$result = mysql_query($sql, $con);
if (!$result) {
  die('Error: ' . mysql_error());
}
 
echo "<h2>Posts from $email</h2>";
echo "<ol class='posts'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
	$content = $row[0];
	$postId = $row[1];
	$createdAt = $row[2];

	$href = "detailPosts.php?" .
			"content=$content&" . 
			"postId=$postId&" .
			"createdAt=$createdAt";
	$href = urlencode($href);
	$preview = substr($content, $PREVIEW_LENGTH) . "...";
    echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>
</div>

<?php
include('php/footer.php');
?>
