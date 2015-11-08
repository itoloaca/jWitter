<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $content = $_GET['content'];
    $author = $_GET['author'];
    $daysago = $_GET['daysago'];
    echo "<h2>Post more recent than $daysago days</h2>";
    echo "<br>";
    echo "<h5>By: $author</h5>";
    echo "<br>";
    echo "<h5 style='font-style: italic; color: gray;'>$content</h5>";
?>
</div>

<?php
include('php/footer.php');
?>
