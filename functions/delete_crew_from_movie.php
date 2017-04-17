<?php
  include 'connection.php';

  $crew = $mysqli->escape_string($_POST['crew_select_movie']);
  $movie_id = $mysqli->escape_string($_POST['movie_select']);

  $deletion_query = $mysqli->query("DELETE FROM has_crew WHERE movie_id=$movie_id AND crew_id=$crew");


?>
