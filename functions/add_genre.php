<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_POST['genre']) && !empty($_POST['genre'])){
    $c_genre = $mysqli->escape_string($_POST['genre']);

    $insertion_query = $mysqli->query("INSERT INTO GENRE(genre) VALUES ('$c_genre')");

    if($insertion_query){

      $_SESSION['status'] = 'Success';
      $_SESSION['message'] = 'Success! The genre "' . $c_genre . '" was added to the database.';

      header("location: ../pages/main_page.php");
    }
    else{
      die("Error");
    }
  }
?>
