<?php
include('php/header.php');
?>

<?php
/////////////////////////////////// 
//Reference: http://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
function time_elapsed_string($ptime)
{
  $etime = time() - $ptime;

  if ($etime < 1)
  {
    return '0 seconds';
  }

  $a = array( 365 * 24 * 60 * 60  =>  'year',
   30 * 24 * 60 * 60  =>  'month',
   24 * 60 * 60  =>  'day',
   60 * 60  =>  'hour',
   60  =>  'minute',
   1  =>  'second'
   );
  $a_plural = array( 'year'   => 'years',
   'month'  => 'months',
   'day'    => 'days',
   'hour'   => 'hours',
   'minute' => 'minutes',
   'second' => 'seconds'
   );

  foreach ($a as $secs => $str)
  {
    $d = $etime / $secs;
    if ($d >= 1)
    {
      $r = round($d);
      return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
    }
  }
}
///////////////////////////////////
include('bootstrap/config.php');
$con = mysql_connect("localhost:3306", "dbwa_sparta", $db_pass);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);
$email = urldecode($_GET["email"]);

$sqlNameId = "SELECT U.name, U.userId
FROM User U
where U.email='$email'";

$sqlOwnCount = "SELECT * FROM User U
INNER JOIN Post P on U.userId = P.authorId
where U.email='$email'";

$sqlFollowerCount = "SELECT *
from User UFollower
inner join FollowerFollowed F on UFollower.userId = F.followerId
inner join User UFollowed on F.followedId = UFollowed.userId 
where UFollower.email = '$email'";

$sqlFollowedCount = "SELECT *
from User UFollowed
inner join FollowerFollowed F on UFollowed.userId = F.followedId
inner join User UFollower on F.followerId = UFollower.userId 
where UFollowed.email = '$email'";

$sqlPosts = "SELECT P.content, P.created_at
FROM User U
INNER JOIN Post P ON U.userId = P.authorId
WHERE U.email = '$email'
ORDER BY P.created_at DESC";


$sqlNameIter = mysql_query($sqlNameId, $con);
$sqlNameId = array();
if (!$sqlNameIter) {
  $sqlNameId["ERROR"] = "Error: " . mysql_error();
} else if (mysql_num_rows($sqlNameIter) == 0) {
 $sqlNameId["ERROR"] = "Error: user not found";
} else {
  $row = mysql_fetch_array($sqlNameIter, MYSQL_NUM);
  $sqlNameId["NAME"] = $row[0];
  $sqlNameId["ID"] = $row[1];
}


$sqlOwnCountIter = mysql_query($sqlOwnCount, $con);
$sqlOwnCount = 0;
if (!$sqlOwnCountIter) {
  $sqlOwnCount = 'Error: ' . mysql_error();
} else {
  $sqlOwnCount = mysql_num_rows($sqlOwnCountIter);
}

$sqlFollowerCountIter = mysql_query($sqlFollowerCount, $con);
if (!$sqlFollowerCountIter) {
  $sqlFollowerCount = 'Error: ' . mysql_error();
} else {
  $sqlFollowerCount = mysql_num_rows($sqlFollowerCountIter);
}


$sqlFollowedCountIter = mysql_query($sqlFollowedCount, $con);
if (!$sqlFollowedCountIter) {
  $sqlFollowedCount = 'Error: ' . mysql_error();
} else {
  $sqlFollowedCount = mysql_num_rows($sqlFollowedCountIter);
}

$sqlPostsIter = mysql_query($sqlPosts, $con);

$sqlPosts = array();
$sqlPosts["HASPOSTS"] = False;
$i = 0;
if (!$sqlPostsIter) {
  $sqlPosts["ERROR"] = "Error: " . mysql_error();
} else if (mysql_num_rows($sqlPostsIter) == 0) {
 $sqlPosts["ERROR"] = "Error: no results ";
} else {
  $sqlPosts["HASPOSTS"] = True;
  $sqlPosts["answers"] = array();
  while($row = mysql_fetch_array($sqlPostsIter, MYSQL_NUM)) {
    $content = $row[0];
    $created_at = $row[1];
    $currResult = array();
    $currResult['content'] = $content;
    $currResult['created_at'] = $created_at;
    array_push($sqlPosts["answers"], $currResult);
  }
}


mysql_close($con);


$default = "http://www.gravatar.com/avatar/03037e249b97891693d6e292289be0ff.png";
$size = 52;
$grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . urlencode( $default ) . "&s=" . $size;

?>

<div class='row'>
  <aside class='span4'>
    <section>
      <a href='#'>
        <img class='gravatar' src='<?php echo $grav_url; ?>'>
      </a>
      <h1>
        <?php echo $sqlNameId["NAME"]; ?>
      </h1>

    </section>
    <section>
      <div class='stats'>
        <a href='#'>
          <strong id='following' class='stat'>
            <?php echo $sqlFollowedCount; ?>
          </strong>
          following
        </a>
        <a href='#'>
          <strong id='followers' class='stat'>
            <?php echo $sqlFollowerCount; ?>
          </strong>
          followers
        </a>
      </div>


    </section>
    <?php
    if (isset($_SESSION["status_success"])) {
      $alert = $_SESSION["status_success"];
      unset($_SESSION["status_success"]);
      echo("<div class='alert alert-success'>{$alert}</div>");
    }
    if (isset($_SESSION["status_failure"])) {
      $alert = $_SESSION["status_failure"];
      unset($_SESSION["status_failure"]);
      echo("<div class='alert alert-error'>{$alert}</div>");
    }
    ?>
  
  </aside>
  <div class='span8'>
    <h3>Micropost Feed</h3>
    <ol class='microposts'>

      <?php 
      $currId = 1;
      foreach($sqlPosts["answers"] as $ans) {
      $content = $ans["content"];
      date_default_timezone_set('Europe/Berlin');
      $created_at = time_elapsed_string(strtotime($ans["created_at"]));
        echo "
        <li id='{$currId}'>
          <span class='content'>{$content}</span>
          <span class='timestamp'>
            {$created_at}
          </span>
        </li>
        ";
        $currId = $currId + 1;
      }
      ?>

    </ol>
    

  </div>
</div>

<?php
include('php/footer.php');
?>