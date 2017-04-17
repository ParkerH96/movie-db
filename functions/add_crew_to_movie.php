<?php
  include 'connection.php';

  $crew = $mysqli->escape_string($_POST['crew_select_movie']);
  $movie_id = $mysqli->escape_string($_POST['movie_select']);

  $insertion_query = $mysqli->query("INSERT INTO has_crew VALUES ($movie_id, $crew)");
?>
