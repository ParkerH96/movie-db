<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, David Cottrell

  Name: add_page.php

  Description: This file contains the PHP code used for adding a MOVIE into the
  database. It also contains the main HTML code for laying out the Add a Movie page.

-->
<!DOCTYPE html>
<html>
  <head>
    <title> Movie-db </title>
    <meta charset="UTF-8">

    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/watchlist_page.css" type="text/css">
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">

  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>
          <i class="fa fa-star" aria-hidden="true"></i>
          Movie-DB
          <i class="fa fa-star" aria-hidden="true"></i>
        </h1>
      </div>
      <div id="tool-bar">
        <a href="home_page.php"><button class="btn btn-info"><i class="fa fa-home" aria-hidden="true"></i></button></a>
        <?php
          include '../functions/session.php';
          if($admin_tag == 1){
            echo
             '<div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                  Manager
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="users_page.php">View Users</a></li>
                  <li><a href="crews_page.php">View Crews</a></li>
                  <li><a href="add_page.php">Add a Movie</a></li>
                </ul>
              </div>';
          }
        ?>
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
            User
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
             <li><a href="main_page.php">Search Movies</a></li>
             <li><a href="watchlist_page.php">My Watchlist</a><li>
          </ul>
        </div>
        <span class="greeting"><?php echo 'Hello, ' . $first_name . ' ' . $last_name; ?></span>
        <button type="button" class="btn btn-danger logout"><a href="../login.php">Logout</a></button>
      </div>
    </div>
    <div class= "row page-content">
      <div class="col-sm-12">
        <h1>Your watchlist:</h1>
        <?php
          include '../functions/connection.php';
          include_once '../functions/star_rating.php';

          $watchlist_query = $mysqli->query("SELECT * FROM watch_list WHERE user_id=$user_id");

          if($watchlist_query){
            while($watchlist_current_row = $watchlist_query->fetch_assoc()){
              $movie_id = $watchlist_current_row['movie_id'];

              $movie_query = $mysqli->query("SELECT * FROM MOVIE WHERE movie_id=$movie_id");
              $genre_query = $mysqli->query("SELECT genre FROM MOVIE, is_genres, GENRE WHERE MOVIE.movie_id = is_genres.movie_id AND GENRE.genre_id = is_genres.genre_id AND MOVIE.movie_id=$movie_id");

              if($movie_query){
                while($current_row = $movie_query->fetch_assoc()){
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
                  $rating = $rating_result['AVG(rating)'];


                  // open search-result div
                  echo '<div class="search-result">';

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

                  //echo '<a href="../pages/rate_page.php?movie_id=' . $movie_id . '&search=' . $title . '"><button type="button" class="btn btn-success">Rate/Comment/Tag</button></a>';
                  echo ' <a href="../functions/delete_watchlist.php?movie_id=' . $movie_id . '&title=' . $title . '" onclick="return confirm(\'Are you sure you want to delete ' . $title . ' from your watch list?\')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>';

                  // close the search-result div
                  echo '</div></div>';

                }
              }
              else{
                die("Movie Error");
              }
            }
            if ($watchlist_query->num_rows == 1) {
              echo $watchlist_query->num_rows . ' result found.<br><br>';
            } else {
              echo $watchlist_query->num_rows . ' results found.<br><br>';
            }
          }
          else{
            die("Error");
          }

        ?>
      </div>
    </div>
  </body>
</html>
