<?php
	session_start();
    unset($_SESSION['0xDEADBEEF']);
    header("Location: index.php");
?>
