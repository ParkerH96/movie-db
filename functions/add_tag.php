<?php
  include 'connection.php';

  $tag = $mysqli->escape_string($_POST['tag']);
  $movie_id = $mysqli->escape_string($_POST['movie_id']);
  $search = $_POST['search'];
  $option = $_POST['option'];
  $sorting_option = $_POST['sorting-option'];

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

      $temp_query = $mysqli->query("SELECT * FROM has_tags WHERE tag_id = $tag_id AND movie_id = $movie_id");

      if($temp_query->num_rows == 0){
        $insertion_query = $mysqli->query("INSERT INTO has_tags VALUES ($tag_id, $movie_id)");
      }

      header("location: ../pages/rate_page.php?movie_id=$movie_id&search=$search&option=$option&sorting-option=$sorting_option");
    }
  }
  else{
    die("Error");
  }


?>
