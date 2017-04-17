<?php
include 'connection.php';
include 'session.php';

if(!empty($_GET)){
  $movie_id = $mysqli->escape_string($_GET['movie_id']);
  $tag_id = $mysqli->escape_string($_GET['tag_id']);
  $search = $mysqli->escape_string($_GET['search']);
  $option = $mysqli->escape_string($_GET['option']);
  $sorting_option = $mysqli->escape_string($_GET['sorting-option']);
  $navigated_from = $mysqli->escape_string($_GET['navigated-from']);
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

  $deletion_query = $mysqli->query("DELETE FROM has_tags WHERE movie_id=$movie_id AND tag_id=$tag_id");

  $_SESSION['status'] = 'Success';
  $_SESSION['message'] = 'Success! The tag has been removed!';
  header("location: ../pages/rate_page.php?movie_id=$movie_id&tag_id=$tag_id&search=$search&option=$option&sorting-option=$sorting_option&navigated-from=$navigated_from$genre_list");
}
?>
