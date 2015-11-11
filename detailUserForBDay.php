<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
<?php
    $userName = $_GET['userName'];
    $bday = $_GET['bday'];
    $email = urldecode($_GET['email']);
    $prefName = $_GET['prefName'];
    echo "<h2>User $userName</h2>";
    echo "<br>";
    echo "<h5>Bday $bday</h5>";
    echo "<br>";
    echo "<h5>Email $email</h5>";
    echo "<br>";
    echo "<h5>Preference of user: $prefName</h5>";
?>
</div>

<?php
include('php/footer.php');
?>