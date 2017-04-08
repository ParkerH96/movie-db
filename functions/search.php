
<?php
/*
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, Evan Heaton

  Name: search.php

  Description: This is the PHP code used for implementing the search functionality on the search page.
  This code also allows for a User to perform a faceted search (by title, tag, genre, crew, etc).

*/


      if(!empty($_GET['search'])){

        include 'connection.php';

        //escape the strings
        $search_key = $mysqli->escape_string($_GET['search']);

        if($_GET['option'] === 'Any'){

          /*
          $search_query = $mysqli->query("SELECT * FROM MOVIE, GENRE, is_genres, has_tags
            WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND MOVIE.movie_id = has_tags.movie_id AND has_tags.tag_id = TAGS.tag_id
            AND (title LIKE '%" . "$search_key" . "%' OR genre LIKE '%" . "$search_key" . "%')");
          */
        }
        else {
          if($_GET['option'] === 'Title'){

            $search_query = $mysqli->query("SELECT * FROM MOVIE WHERE title LIKE '%" . "$search_key" . "%'");

          }
          else if($_GET['option'] === 'Genre'){

            $search_query = $mysqli->query("SELECT * FROM MOVIE, GENRE, is_genres WHERE MOVIE.movie_id = is_genres.movie_id AND is_genres.genre_id = GENRE.genre_id AND genre LIKE '%$search_key%' GROUP BY (MOVIE.movie_id)");

          }
          else if($_GET['option'] === 'Tag'){

            $search_query = $mysqli->query("SELECT * FROM MOVIE, TAGS, has_tags WHERE MOVIE.movie_id = has_tags.movie_id AND has_tags.tag_id = TAGS.tag_id AND tag LIKE '%$search_key%' GROUP BY (MOVIE.movie_id)");

          }

          if($search_query){

            // for each search result, print out a little block of info
            while($current_row = $search_query->fetch_assoc()){
              $movie_id = $current_row['movie_id'];
              $title = $current_row['title'];
              $release_date = substr($current_row['release_date'], 0, 4);
              $full_release_date = $current_row['release_date'];
              $summary = $current_row['summary'];
              $language = $current_row['language'];
              $duration = $current_row['duration'];
              $trailer = $current_row['trailer'];
              $poster = $current_row['poster'];

              $rating_query = $mysqli->query("SELECT AVG(rating) FROM user_actions WHERE movie_id=$movie_id");
              $rating_result = $rating_query->fetch_assoc();

              if($rating_result['AVG(rating)'][2] === '.'){
                $rating_avg = substr($rating_result['AVG(rating)'], 0, 2);
              }
              else{
                $rating_avg = substr($rating_result['AVG(rating)'], 0, 3);
              }

              if($rating_avg >= 8){
                $btn_type = 'success';
              }
              else if($rating_avg >= 6){
                $btn_type = 'primary';
              }
              else if($rating_avg >= 4){
                $btn_type = 'info';
              }
              else if($rating_avg >= 2){
                $btn_type = 'warning';
              }
              else{
                $btn_type = 'danger';
              }

              // open search-result div
    				  echo '<div class="search-result"><div class="search-rating"><button type="button" class="btn btn-' . $btn_type . '">' . $rating_avg . '</button></div>' .
                    '<div class="search-result-info"> <div class="search-result-poster-container">' .
                      '<img class="search-result-poster" src="../images/posters/' . $poster . '"/>' .
                    '</div><div class="search-result-text">' .
                    '<h3>' . $title . '</h3>' . $release_date . ' ‧ ' . $duration . '<br>' . $summary;

              //open the search-result-admin-functions div
              echo '</div></div><div class="search-result-admin-functions">';

              if ($admin_tag == 1) {
                echo '<a href="../functions/delete.php?movie_id=' . $movie_id . '&search=' . $search_key . '" onclick="return confirm(\'Are you sure you want to delete ' . $title . '?\')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>
                      <a href="../pages/edit_page.php?movie_id=' . $movie_id . '&title=' . $title . '&release_date=' . $full_release_date . '&summary=' . $summary . '&language=' . $language . '&duration=' . $duration . '"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-edit"></span></button></a> ';
              }

              echo '<a href="../pages/rate_page.php?movie_id=' . $movie_id . '&search=' . $search_key . '"><button type="button" class="btn btn-success">Rate/Comment/Tag</button></a>';

              // close the search-result div
              echo '</div></div>';
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
?>
