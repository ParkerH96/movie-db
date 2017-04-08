<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['movie_id']) && !empty($_GET['movie_id'])){

    //escape the strings
    $movie_id = $mysqli->escape_string($_GET['movie_id']);

    /*
      DELETE FROM is_genres WHERE movie_id = 1;
      DELETE FROM has_tags WHERE movie_id = 1;
      DELETE FROM user_actions WHERE movie_id = 1;
      DELETE FROM has_crew WHERE movie_id = 1;
      DELETE FROM MOVIE WHERE movie_id = 1;
    */

    $delete_is_genres = $mysqli->query("DELETE FROM is_genres WHERE movie_id = $movie_id");
    $delete_has_tags = $mysqli->query("DELETE FROM has_tags WHERE movie_id = $movie_id");
    $delete_user_actions = $mysqli->query("DELETE FROM user_actions WHERE movie_id = $movie_id");
    $delete_has_crew = $mysqli->query("DELETE FROM has_crew WHERE movie_id = $movie_id");
    $delete_movie = $mysqli->query("DELETE FROM MOVIE WHERE movie_id = $movie_id");

    if($delete_is_genres && $delete_has_tags && $delete_user_actions && $delete_has_crew && $delete_movie){

      $search = $_GET['search'];

      $_SESSION['status'] = 'Success';
      $_SESSION['message'] = 'Success! The movie was removed from the database.';

      if(isset($_GET['search']) && !empty($_GET['search'])){
        //success! redirect them back to the main page
        header("location: ../pages/main_page.php?option=Title&search=$search&submit=Search");
      }
      else {
        header("location: ../pages/main_page.php");
      }
    }
    else{
      die();
    }
  }

  //Close the current connection
  $mysqli->close();
?>
