<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_POST['role']) && !empty($_POST['role'])){
    $role_name = $mysqli->escape_string($_POST['role']);

    $insertion_query = $mysqli->query("INSERT INTO ROLE(role) VALUES ('$role_name')");

    if($insertion_query){

      $_SESSION['status'] = 'Success';
      $_SESSION['message'] = 'Success! The role "' . $role_name . '" was added to the database.';

      header("location: ../pages/crews_page.php");
    }
    else{
      die("Error");
    }
  }
?>
