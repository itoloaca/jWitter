<?php
session_start();
include('bootstrap/config.php');
include('debug.php');
?>
<!DOCTYPE html>
<html>
<head>
    <title>jWitter</title>
    
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="css/bootstrap.min.css">

  <link rel="stylesheet" href="css/custom.css">

</head>
<body>
    <header class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
    <a href="index"><img alt="JwitterLogo" src="img/jWitterLogo.png" style="float: left;"/>
      <a href="index" id="logo" style="text-transform: none;">&nbsp;&nbsp;jWitter</a>
      <nav>
        <ul class="nav pull-right">
          <li><a href="index">Home</a></li>
             <?php 
              if (!isset($_SESSION["0xDEADBEEF"])) {
                echo "<li><a href='signin.php'>Sign in</a></li>";
                
              } else {
                echo "<li><a href='users.php'>Users</a></li>";
                echo "<li><a href='logout.php'>Log out</a></li>";
              }

              ?>
            <li><a style="color:green" href="input_form_maintenance">Maintenance</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>
<div class="container">
