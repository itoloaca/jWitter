<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $vendor = urldecode($_GET['vendor']);
    $minads = $_GET['minads'];

    echo "<h2>One of the thriving  vendors who have above-average exposures and more than $minads ads</h2>";
    echo "<br>";
    echo "<h1 style='font-style: italic; color: magenta;'>... is $vendor!</h1>";
?>

</div>

<?php
include('php/footer.php');
?>
