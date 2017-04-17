<?php
  include 'connection.php';
  include 'session.php';

  $tag = $mysqli->escape_string($_POST['tag']);
  $movie_id = $mysqli->escape_string($_POST['movie_id']);
  $navigation = $_POST['navigated-from'];
  //$genre_list = '';

  /*if(isset($_POST['genrelist']) && !empty($_POST['genrelist'])){
    $genre = $_POST['genrelist'];
    foreach($genre as $genre_value){
      if($genre_value != ''){
        $genre_list .= '&genre[]=';
        $genre_list .= $genre_value;
      }
    }
  }*/

  if($navigation == 'search'){
    $search = $_POST['search'];
    $option = $_POST['option'];
    $sorting_option = $_POST['sorting-option'];
  }

  $tag_query = $mysqli->query("SELECT * FROM TAGS WHERE tag = '$tag'");

  if($tag_query){
    if($tag_query->num_rows == 0){

      //The tag does not exist in the database so add it
      $insertion_tag_query = $mysqli->query("INSERT INTO TAGS(tag) VALUES ('$tag')");
    }

    $tag_id_query = $mysqli->query("SELECT tag_id FROM TAGS WHERE tag = '$tag'");
    if($tag_id_query){
      $tag_tuple = $tag_id_query->fetch_assoc();

      $tag_id = $tag_tuple['tag_id'];

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
    }
  }
  else{
    die("Error");
  }


?>
