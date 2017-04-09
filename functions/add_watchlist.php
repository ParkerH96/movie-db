<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['title']) && !empty($_GET['title'])){

    $movie_id = $_GET['movie_id'];
    $title = $_GET['title'];

    $insertion_query = $mysqli->query("INSERT INTO watch_list VALUES ($user_id, $movie_id)");

    if($insertion_query){

      $_SESSION['status'] = 'Success';
      $_SESSION['message'] = 'Success! "' . $title . '" was added to your watch list!';

      header("location: ../pages/main_page.php");

    }
  }
?>
