<?php
include('php/header.php');
?>


<?php

$con = mysql_connect("localhost:3306", "dbwa_sparta", $db_pass);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);

$sqlUserList = "SELECT U.name, U.email
FROM User U
ORDER BY name ASC";


$sqlUserIter = mysql_query($sqlUserList, $con);
$sqlUserList = array();

if (!$sqlUserIter) {
  $sqlUserList["ERROR"] = "Error: " . mysql_error();
} else if (mysql_num_rows($sqlUserIter) == 0) {
 $sqlUserList["ERROR"] = "Error: no results ";
} else {
  $sqlUserList["users"] = array();
  while($row = mysql_fetch_array($sqlUserIter, MYSQL_NUM)) {
    $name = $row[0];
    $tmpEmail = $row[1];
    $currResult = array();
    $currResult['name'] = $name;
    $currResult['email'] = $tmpEmail;
    array_push($sqlUserList["users"], $currResult);
  }
}


mysql_close($con);


$default = "http://www.gravatar.com/avatar/03037e249b97891693d6e292289be0ff.png";
$size = 52;

?>

<h1>User List</h1>

<ul class="users">
  <?php 
  foreach($sqlUserList["users"] as $user) {
    $name = $user["name"];
    $email = $user["email"];
    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;
    $href = "profile.php?email=" . urlencode($email);
    echo "
    <li>
      <img class='gravatar' src='$grav_url'>
      <a href='$href'>$name</a>
    </li>
    "; }
    ?>
  </ul>


  <?php
  include('php/footer.php');
  ?>


