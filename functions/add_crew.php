<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_POST['crew']) && !empty($_POST['crew'])){
    $crew_name = $mysqli->escape_string($_POST['crew']);

    $insertion_query = $mysqli->query("INSERT INTO CREW(name) VALUES ('$crew_name')");

    if($insertion_query){

      $_SESSION['status'] = 'Success';
      $_SESSION['message'] = 'Success! The crew "' . $crew_name . '" was added to the database.';

      header("location: ../pages/crews_page.php");
    }
    else{
      die("Error");
    }
  }
?>
