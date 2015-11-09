<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $count = $_GET['count'];
    $email = $_GET['email'];

    echo "<h2>The exciting number of users that follow $email</h2>";
    echo "<br>";
    echo "<h1 style='font-style: italic; color: magenta;'>... is $count !</h1>";
?>
</div>

<?php
include('php/footer.php');
?>
