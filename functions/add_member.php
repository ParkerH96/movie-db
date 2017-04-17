<?php
  include 'connection.php';
  include 'session.php';

  $first_name = $mysqli->escape_string($_POST['first_name']);
  $middle_name = $mysqli->escape_string($_POST['middle_name']);
  $last_name = $mysqli->escape_string($_POST['last_name']);
  $dob = $mysqli->escape_string($_POST['dob']);
  $gender = $mysqli->escape_string($_POST['gender']);

  $insertion_query = $mysqli->query("INSERT INTO MEMBER(first_name, middle_name, last_name, dob, gender) VALUES ('$first_name', '$middle_name', '$last_name', '$dob', '$gender')");

  if($insertion_query){

    $_SESSION['status'] = 'Success';
    $_SESSION['message'] = 'Success!';

    header("location: ../pages/crews_page.php");
  }
  else{
    die("Error");
  }

?>
