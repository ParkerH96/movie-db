<!--
  Team Databased 2017: Movie-DB
  Author(s): Davud Cottrell

  Name: tags.php

  Description: This file contains the PHP code used displaying tags

-->
<?php
  function displayTags($movie_title) {
      include 'connection.php';
      $search_query = $mysqli->query("SELECT * FROM MOVIE, TAGS, has_tags WHERE MOVIE.movie_id = has_tags.movie_id AND has_tags.tag_id = TAGS.tag_id AND title LIKE '$movie_title'");
      if($search_query){
        while($current_tag = $search_query->fetch_assoc()){
            echo $current_tag['tag'];
        }

      }
  }

  function addTag($movie_title, $tag) {
    include 'connection.php';
    $get_all_tags_query = $mysqli->query("SELECT * FROM TAGS");
    $all_tags = $get_all_tags_query->fetch_assoc();
    if(in_array($tag, $all_tags)) {
        $add_tag = $mysqli->query("INSERT INTO TAG VALUES ('$tag')");
    }
  }
?>
