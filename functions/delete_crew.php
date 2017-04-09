<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['crew_id']) && !empty($_GET['crew_id'])){

    //escape the string
    $c_crew_id = $mysqli->escape_string($_GET['crew_id']);

    $delete_has_members = $mysqli->query("DELETE FROM has_members WHERE crew_id = $c_crew_id");
    $delete_has_crew = $mysqli->query("DELETE FROM has_crew WHERE crew_id = $c_crew_id");
    $delete_crew = $mysqli->query("DELETE FROM CREW WHERE crew_id = $c_crew_id");

    if($delete_has_members && $delete_crew && $delete_has_crew){

      //$_SESSION['message'] = 'Success! The User was deleted from the database.';
      //$_SESSION['status'] = 'Success';

      header("location: ../pages/crews_page.php");
    }
    else{
      die("Error.");
    }
  }
?>
