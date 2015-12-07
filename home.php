<?php
session_start();
include('bootstrap/config.php');
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

$con = mysql_connect("localhost:3306", "dbwa_sparta", $db_pass);
if (!$con) {
  die('Could not connect: ' . mysql_error());
}

mysql_select_db("dbwa_sparta", $con);
$email = $_SESSION["0xDEADBEEF"];
$sqlName = "SELECT U.name
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

$sqlPosts = "SELECT U.name, P.content, P.created_at
FROM User U
INNER JOIN FollowerFollowed F ON U.userId = F.followerId
INNER JOIN Post P ON F.followedId
WHERE U.email = '$email'";


$sqlNameIter = mysql_connect($sqlName, $con);
if (!$sqlNameIter) {
  $sqlName = "Error: " . mysql_error();
} else if (mysql_num_rows($sqlNameIter) == 0) {
   $sqlName = "Error: user not found";
else {
  $row = mysql_fetch_array($sqlNameIter, MYSQL_NUM);
  $sqlName = $row[0];
}


$sqlOwnCountIter = mysql_query($sqlOwnCount, $con);
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

$sqlPostsIter = mysql_connect($sqlPosts, $con);

$sqlPosts = array();
$sqlPosts["HASPOSTS"] = False;
$i = 0;
if (!$sqlPostsIter) {
  $sqlPosts["ERROR"] = "Error: " . mysql_error();
} else if (mysql_num_rows($sqlPostsIter) == 0) {
   $sqlPosts["ERROR"] = "Error: no results ";
else {
  $sqlPosts["HASPOSTS"] = True;
  $sqlPosts["answers"] = [];
  while($row = mysql_fetch_array($sqlPostsIter, MYSQL_NUM)) {
    $name = $row[0];
    $content = $row[1];
    $created_at = $row[2];
    $currResult = array();
    $currResult['name'] = $name;
    $currResult['content'] = $content;
    $currResult['created_at'] = $created_at;
    array_push($sqlPosts["answers"], $currResult);
  }
}



echo "<h2>Posts from $email</h2>";
if (mysql_num_rows($result) == 0) {
  echo "<h5 style='color: red;'>No results found!</h5>";
  die();
}
echo "<ol class='posts'>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {
  $preview = substr($row[0], $PREVIEW_LENGTH) . "...";
  $content_encoded = urlencode($row[0]);
  $postId = urlencode($row[1]);
  $createdAt = urlencode($row[2]);
  $email = urlencode($email);

  $href = "detailPosts.php?" .
  "content=$content_encoded&" . 
  "postId=$postId&" .
  "createdAt=$createdAt&" .
  "email=$email";
  echo "<li><a href='$href'>$preview</a></li>";
}
echo "</ol>";

mysql_close($con);
?>

<div class="row">
  <aside class="span4">
    <section>
      <a href="/users/103">
        <img alt="Ivan " class="gravatar" src="http://www.gravatar.com/avatar/45f38e6772f559c4a619207d755bb8b8.png?s=52">
      </a>
      <h1>
        Ivan 
      </h1>
      <span>
        <a href="/users/103">view my profile</a>
      </span>
      <span>
        0 microposts
      </span>

    </section>
    <section>
      <div class="stats">
        <a href="/users/103/following">
          <strong id="following" class="stat">
            1
          </strong>
          following
        </a>
        <a href="/users/103/followers">
          <strong id="followers" class="stat">
            0
          </strong>
          followers
        </a>
      </div>


    </section>
    <section>
      <form accept-charset="UTF-8" action="/microposts" class="new_micropost" id="new_micropost" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="✓"><input name="authenticity_token" type="hidden" value="/FwC2PuAyZEwe6ezzdUfbdqOpylCKjqg/91OqKU/N5s="></div>

        <div class="field">
          <textarea cols="40" id="micropost_content" name="micropost[content]" placeholder="Compose new micropost..." rows="20"></textarea>
        </div>
        <input class="btn btn-large btn-primary" name="commit" type="submit" value="Post">
        <span class="countdown pull-right">140 characters left </span>
      </form>
    </section>
  </aside>
  <div class="span8">
    <h3>Micropost Feed</h3>
    <ol class="microposts">

      <li id="122">
        <a href="/users/2"><img alt="Christina Brakus" class="gravatar" src="http://www.gravatar.com/avatar/03037e249b97891693d6e292289be0ff.png?s=50"></a>
        <span class="user">
          <a href="/users/2">Christina Brakus</a>
        </span>
        <span class="content">Qui quos repellendus dolorem veniam excepturi.</span>
        <span class="timestamp">
          Posted almost 2 years ago.
        </span>
      </li>

    </ol>
    

  </div>
</div>