<?php
include 'connection.php';

if(!empty($_POST['genre_select']) && !empty($_POST['movie_id'])){
  $genre_id = $mysqli->escape_string($_POST['genre_select']);
  $movie_id = $mysqli->escape_string($_POST['movie_id']);

  $movie_query = $mysqli->query("SELECT * FROM is_genres WHERE movie_id=$movie_id AND genre_id=$genre_id");

  if($movie_query->num_rows != 1){
    $insertion_query = $mysqli->query("INSERT INTO is_genres VALUES ($movie_id, $genre_id)");
  }
}
?>
