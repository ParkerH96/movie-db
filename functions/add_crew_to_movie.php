<?php
  include 'connection.php';

  $crew = $mysqli->escape_string($_POST['crew_select_movie']);
  $movie_id = $mysqli->escape_string($_POST['movie_select']);

  $crew_movie_query = $mysqli->query("SELECT * FROM has_crew WHERE crew_id=$crew AND movie_id=$movie_id");

  if($crew_movie_query->num_rows == 0){
    $insertion_query = $mysqli->query("INSERT INTO has_crew VALUES ($movie_id, $crew)");
  }
?>
