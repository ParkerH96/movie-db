<!--
  Team Databased 2017: Movie-DB
  Author(s): Evan Heaton, Parker Householder

  Name: display_search_result.php

  Description: This file contains the PHP code used for displaying search results

-->
<?php

  function displaySearchResult($movie_id, $admin, $search_key, $display_button_rating, $option, $sorting_option) {

    include_once 'star_rating.php';
    include 'connection.php';

    $movie_query = $mysqli->query("SELECT * FROM MOVIE WHERE movie_id = $movie_id");
    $genre_query = $mysqli->query("SELECT genre FROM MOVIE, is_genres, GENRE WHERE MOVIE.movie_id = is_genres.movie_id AND GENRE.genre_id = is_genres.genre_id AND MOVIE.movie_id=$movie_id");

    if($movie_query){

      $movie_tuple = $movie_query->fetch_assoc();

      $title = $movie_tuple['title'];
      $release_date = substr($movie_tuple['release_date'], 0, 4);
      $full_release_date = $movie_tuple['release_date'];
      $summary = $movie_tuple['summary'];
      $language = $movie_tuple['language'];
      $duration = $movie_tuple['duration'];
      $trailer = $movie_tuple['trailer'];
      $poster = $movie_tuple['poster'];

      $rating_query = $mysqli->query("SELECT AVG(rating) FROM user_actions WHERE movie_id=$movie_id");
      $rating_tuple = $rating_query->fetch_assoc();
      $rating = $rating_tuple['AVG(rating)'];
    }

    if ($display_button_rating) {
      if($rating_tuple['AVG(rating)'][2] === '.'){
        $rating = substr($rating_tuple['AVG(rating)'], 0, 2);
      }
      else{
        $rating = substr($rating_tuple['AVG(rating)'], 0, 3);
      }

      if($rating >= 8){
        $btn_type = 'success';
      }
      else if($rating >= 6){
        $btn_type = 'primary';
      }
      else if($rating >= 4){
        $btn_type = 'info';
      }
      else if($rating >= 2){
        $btn_type = 'warning';
      }
      else{
        $btn_type = 'danger';
      }
    }

    // open search-result div
    echo '<div class="search-result">';

    if ($display_button_rating) {
      echo '<div class="search-rating"><button type="button" class="btn btn-' . $btn_type . '">' . $rating . '</button></div>';
    }

    echo  '<div class="search-result-info"> <div class="search-result-poster-container">' .
          '<img class="search-result-poster" src="../images/posters/' . $poster . '"/>' .
          '</div><div class="search-result-text">' .
          '<h3>' . $title . ' - ';

    displayStarRating($rating, 1);

    echo  '</h3>';

    $count = 0;
    while($genre_tuple = $genre_query->fetch_assoc()){
      $c_genre = $genre_tuple['genre'];
      $count++;
      if($count == $genre_query->num_rows){
        echo $c_genre . ' ‧ ';
      }
      else{
        echo $c_genre . ', ';
      }
    }

    echo $release_date . ' ‧ ' . $duration . '<br><br>' . $summary;

    //open the search-result-admin-functions div
    echo '</div></div><div class="search-result-admin-functions">';

    if ($admin == 1) {
      echo '<a href="../functions/delete.php?movie_id=' . $movie_id . '&search=' . $search_key . '&option=' . $option .'&sorting-option=' . $sorting_option . '" onclick="return confirm(\'Are you sure you want to delete ' . $title . '?\')"><button type="button" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></button></a>
            <a href="../pages/edit_page.php?movie_id=' . $movie_id . '&search=' . $search_key . '&option=' . $option .'&sorting-option=' . $sorting_option . '"><button type="button" class="btn btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a> ';
    }

    echo '<a href="../pages/rate_page.php?movie_id=' . $movie_id . '&search=' . $search_key . '&option=' . $option .'&sorting-option=' . $sorting_option . '"><button type="button" class="btn btn-success">Rate/Comment/Tag</button></a>
           <a href="../functions/add_watchlist.php?movie_id=' . $movie_id .'&search=' . $search_key .'&title=' . $title . '&option=' . $option .'&sorting-option=' . $sorting_option . '"><button class="btn btn-info">Add to Watchlist</button></a>';

    // close the search-result div
    echo '</div></div>';
  }
?>
