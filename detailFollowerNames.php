<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $name = $_GET['name'];
    $femail = $_GET['femail'];
    $email = $_GET['email'];

    echo "<h2>An exciting user that follows $email</h2>";
    echo "<br>";
    echo "<h1 style='font-style: italic; color: magenta;'>... is named $name and has an email that reads $femail !</h1>";
?>
</div>

<?php
include('php/footer.php');
?>
