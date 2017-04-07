<?php
  include 'connection.php';

  if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['search']) && !empty($_GET['search'])){

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

      //success! redirect them back to the main page
      header("location: main_page.php?option=Title&search=$search&submit=Search");
    }
    else{
      die();
    }
  }
?>
