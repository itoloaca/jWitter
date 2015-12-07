<?php
session_start();
include('config.php');
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
            <li><a href="signin.php">Sign in</a></li>
            <li><a style="color:green" href="input_form_maintenance">Maintenance</a></li>
        </ul>
      </nav>
    </div>
  </div>
</header>
<div class="container">
