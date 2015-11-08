<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $email = urldecode($_GET['email']);
    $content = $_GET['content'];
    $postId = $_GET['postId'];
    $createdAt = $_GET['createdAt'];
    echo "<h2>Post with id $postId</h2>";
    echo "<br>";
    echo "<h5>Created at: $createdAt</h5>";
    echo "<br>";
	echo "<h5>By: $email</h5>";
    echo "<br>";
    echo "<h5 style='font-style: italic; color: gray;'>$content</h5>";
?>
</div>

<?php
include('php/footer.php');
?>
