<?php
include('php/header.php');
?>

<?php
$_SESSION["email"] = "FAKEVAL";

if (!isset($_SESSION["email"])) {
	readfile('basicindex.html'); 
} else {
	include('home.php');
} 
?>
<?php
include('php/footer.php');
?>
