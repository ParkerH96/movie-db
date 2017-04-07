<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder

  Name: connection.php

  Description: This is the PHP code used for establishing a connection to the
  MySQL Database with proper error checking.

-->
<?php
  //Establish a connection to the database
  $mysqli = new mysqli('localhost', 'root', '', 'Databased_movie');

  //Check if there is an error when connecting to the database
  if($mysqli->connect_error){
    die($mysqli->connect_errno . ' : ' . $mysqli->connect_error);
  }
?>
