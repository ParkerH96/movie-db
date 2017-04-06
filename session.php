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
