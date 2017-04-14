<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['title']) && !empty($_GET['title'])){

    $movie_id = $mysqli->escape_string($_GET['movie_id']);
    $title = $_GET['title'];
    $search = $_GET['search'];
    $option = $_GET['option'];
    $sorting_option = $_GET['sorting-option'];
    $genre_list = '';

    if(isset($_GET['genre']) && !empty($_GET['genre'])){
      $genre = $_GET['genre'];
      foreach($genre as $genre_value){
        if($genre_value != ''){
          $genre_list .= '&genre[]=';
          $genre_list .= $genre_value;
        }
      }
    }

    //check to see if it is already on the watchlist
    $watchlist_query = $mysqli->query("SELECT * FROM watch_list WHERE user_id = $user_id AND movie_id = $movie_id");

    if($watchlist_query->num_rows == 1){

      $_SESSION['status'] = 'Failure';
      $_SESSION['message'] = 'Request Failed! "' . $title . '" is already on your watchlist. <a href="../pages/watchlist_page.php">View Watchlist</a>';

      header("location: ../pages/main_page.php?search=$search&option=$option&sorting-option=$sorting_option&submit=Search$genre_list");
    }
    else{
      $insertion_query = $mysqli->query("INSERT INTO watch_list VALUES ($user_id, $movie_id)");

      if($insertion_query){

        $_SESSION['status'] = 'Success';
        $_SESSION['message'] = 'Success! "' . $title . '" was added to your watch list! <a href="../pages/watchlist_page.php">View Watchlist</a>';

        header("location: ../pages/main_page.php?search=$search&option=$option&sorting-option=$sorting_option&submit=Search$genre_list");

      }
    }
  }
?>
