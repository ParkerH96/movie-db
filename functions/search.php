
<?php
/*
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, Evan Heaton, David Cottrell

  Name: search.php

  Description: This is the PHP code used for implementing the search functionality on the search page.
  This code also allows for a User to perform a faceted search (by title, tag, genre, crew, etc).

*/
      include 'connection.php';
      include 'display_search_result.php';

      if(!empty($_POST['search'])){

        //escape the strings
        $search_key = $mysqli->escape_string($_POST['search']);

        if($_POST['option'] === 'Any'){

          /*
          $search_query = $mysqli->query("SELECT * FROM MOVIE, GENRE, is_genres, has_tags
            WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND MOVIE.movie_id = has_tags.movie_id AND has_tags.tag_id = TAGS.tag_id
            AND (title LIKE '%" . "$search_key" . "%' OR genre LIKE '%" . "$search_key" . "%')");
          */
        }
        else {
          if($_POST['option'] === 'Title'){

            if($_POST['sorting-option'] === 'Alphabetical'){
              $order_option = 'title';
            }
            else if($_POST['sorting-option'] === 'Release Year'){
              $order_option = 'release_date';
            }
            else if($_POST['sorting-option'] === 'Duration'){
              $order_option = 'duration';
            }
            else{
              $order_option = '';
            }

            $search_query = $mysqli->query("SELECT * FROM MOVIE WHERE title LIKE '%$search_key%' ORDER BY $order_option");

          }
          else if($_POST['option'] === 'Genre'){

            if($_POST['sorting-option'] === 'Alphabetical'){
              $order_option = 'title';
            }
            else if($_POST['sorting-option'] === 'Release Year'){
              $order_option = 'release_date';
            }
            else if($_POST['sorting-option'] === 'Duration'){
              $order_option = 'duration';
            }
            else{
              $order_option = '';
            }

            $search_query = $mysqli->query("SELECT * FROM MOVIE, GENRE, is_genres WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND genre LIKE '%$search_key%' GROUP BY (MOVIE.movie_id) ORDER BY $order_option");

          }
          else if($_POST['option'] === 'Tag'){

            if($_POST['sorting-option'] === 'Alphabetical'){
              $order_option = 'title';
            }
            else if($_POST['sorting-option'] === 'Release Year'){
              $order_option = 'release_date';
            }
            else if($_POST['sorting-option'] === 'Duration'){
              $order_option = 'duration';
            }
            else{
              $order_option = '';
            }

            $search_query = $mysqli->query("SELECT * FROM MOVIE, TAGS, has_tags WHERE MOVIE.movie_id = has_tags.movie_id AND has_tags.tag_id = TAGS.tag_id AND tag LIKE '%$search_key%' GROUP BY (MOVIE.movie_id) ORDER BY $order_option");

          }

          if($search_query){

            // for each search result, print out a little block of info
            while($current_row = $search_query->fetch_assoc()){
              $movie_id = $current_row['movie_id'];

              displaySearchResult($movie_id, $admin_tag, $search_key, 0);

            }

            if ($search_query->num_rows == 1) {
              echo $search_query->num_rows . ' result found.<br><br>';
            } else {
              echo $search_query->num_rows . ' results found.<br><br>';
            }
          }
          else {
            die('Error');
          }
        }
      }
      else{

        if(!empty($_POST['genre'])){
          $search_key = "";
          $genre = $_POST['genre'];
          $counter = 0;
          $genre_query = "";
          foreach ($genre as $genre_values) {
            if ($counter != 0) {
              $genre_query .= " UNION ";
              $genre_query .=  "SELECT DISTINCT MOVIE.movie_id FROM MOVIE, GENRE, is_genres WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND genre LIKE '%$genre_values%'";
            }
            else {
              $genre_query .=  "SELECT DISTINCT MOVIE.movie_id FROM MOVIE, GENRE, is_genres WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND genre LIKE '%$genre_values%'";
            }
            $counter += 1;
          }
          $genre_query = $mysqli->query($genre_query);
          if($genre_query){

            // for each search result, print out a little block of info
            while($current_row = $genre_query->fetch_assoc()){
              $movie_id = $current_row['movie_id'];

              displaySearchResult($movie_id, $admin_tag, $search_key, 0);

            }

            if ($genre_query->num_rows == 1) {
              echo $genre_query->num_rows . ' result found.<br><br>';
            } else {
              echo $genre_query->num_rows . ' results found.<br><br>';
            }
          }
          else {
            die('Error');
          }
      }
    }

?>
