<?php
include 'connection.php';

if(!empty($_POST['genre_select']) && !empty($_POST['movie_id'])){
  $genre_id = $mysqli->escape_string($_POST['genre_select']);
  $movie_id = $mysqli->escape_string($_POST['movie_id']);
  $search = $_POST['search'];
  $option = $_POST['option'];
  $sorting_option = $_POST['sorting-option'];

  $deletion_query = $mysqli->query("DELETE FROM is_genres WHERE genre_id=$genre_id AND movie_id=$movie_id");

  header("location: ../pages/edit_page.php?movie_id=$movie_id&search=$search&option=$option&sorting-option=$sorting_option");
}
?>
