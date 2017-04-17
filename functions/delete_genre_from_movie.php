<?php
include 'connection.php';

if(!empty($_POST['genre_select']) && !empty($_POST['movie_id'])){
  $genre_id = $mysqli->escape_string($_POST['genre_select']);
  $movie_id = $mysqli->escape_string($_POST['movie_id']);

  $genre_query = $mysqli->query("SELECT * FROM is_genres WHERE movie_id=$movie_id");

  if($genre_query->num_rows != 1){
    $deletion_query = $mysqli->query("DELETE FROM is_genres WHERE genre_id=$genre_id AND movie_id=$movie_id");
  }
}
?>
