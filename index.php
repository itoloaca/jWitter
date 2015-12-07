<?php
include('php/header.php');
?>

<?php
if (!isset($_SESSION["0xDEADBEEF"])) {
	readfile('basicindex.html'); 
} else {
	include('home.php');
} 
?>
<?php
include('php/footer.php');
?>
