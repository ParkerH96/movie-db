<?php
  include 'connection.php';

  if(isset($_GET['title']) && isset($_GET['movie_id']) && !empty($_GET['title']) && !empty($_GET['movie_id'])){

    //escape the strings
    $title = $mysqli->escape_string($_GET['title']);
    $summary = $mysqli->escape_string($_GET['movie_id']);

    $delete_query = $mysqli->query("DELETE FROM  ");
  }
?>
