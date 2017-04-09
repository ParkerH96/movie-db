<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['title']) && !empty($_GET['title'])){

    $movie_id = $_GET['movie_id'];
    $title = $_GET['title'];

    $deletion_query = $mysqli->query("DELETE FROM watch_list WHERE user_id = $user_id AND movie_id = $movie_id");

    if($deletion_query){

      //$_SESSION['status'] = 'Success';
      //$_SESSION['message'] = 'Success! "' . $title . '" was added to your watch list!';

      header("location: ../pages/watchlist_page.php");

    }
  }
?>
