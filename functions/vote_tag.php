<?php
  include 'connection.php';
  include 'session.php';

  $tag_id = $mysqli->escape_string($_GET['tag_id']);
  $movie_id = $mysqli->escape_string($_GET['movie_id']);
  $navigation = $_GET['navigated-from'];
  //$genre_list = '';

  /*if(isset($_GET['genrelist']) && !empty($_GET['genrelist'])){
    $genre = $_GET['genrelist'];
    foreach($genre as $genre_value){
      if($genre_value != ''){
        $genre_list .= '&genre[]=';
        $genre_list .= $genre_value;
      }
    }
  }*/

  if($navigation == 'search'){
    $search = $_GET['search'];
    $option = $_GET['option'];
    $sorting_option = $_GET['sorting-option'];
  }

  $temp_query = $mysqli->query("SELECT * FROM has_tags WHERE tag_id = $tag_id AND movie_id = $movie_id AND user_id=$user_id");

  if($temp_query->num_rows == 0){
    $insertion_query = $mysqli->query("INSERT INTO has_tags VALUES ($tag_id, $movie_id, $user_id)");
  }

  if($navigation == 'search'){
    header("location: ../pages/rate_page.php?movie_id=$movie_id&search=$search&option=$option&sorting-option=$sorting_option&navigated-from=$navigation");
  }
  else{
    header("location: ../pages/rate_page.php?movie_id=$movie_id&navigated-from=$navigation");
  }


?>
