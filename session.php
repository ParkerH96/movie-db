<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder

  Name: session.php

  Description: This is the PHP code used for establishing a session and session
  variables to keep track of a user while logged in

-->
<?php
  //creates a session for storing data across pages
  session_start();

  if($_SESSION['logged_in'] != true){
    header("location: login.php");
  }
  else {
    $first_name = $_SESSION['first_name'];
    $middle_name = $_SESSION['middle_name'];
    $last_name = $_SESSION['last_name'];
    $admin_tag = $_SESSION['admin_tag'];

  }
?>
