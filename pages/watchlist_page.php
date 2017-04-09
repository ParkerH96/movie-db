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
    <link rel="stylesheet" href="https://use.fontawesome.com/2b865347a6.css">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/watchlist_page.css" type="text/css">
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">

  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>Movie-DB</h1>
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
      <?php
        include '../functions/connection.php';

        $watchlist_query = $mysqli->query("SELECT * FROM watch_list WHERE user_id=$user_id");

        if($watchlist_query){
          while($watchlist_current_row = $watchlist_query->fetch_assoc()){
            $movie_id = $watchlist_current_row['movie_id'];

            $movie_query = $mysqli->query("SELECT * FROM MOVIE WHERE movie_id=$movie_id");

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

                echo '<a href="../pages/rate_page.php?movie_id=' . $movie_id . '&search="><button type="button" class="btn btn-success">Rate/Comment/Tag</button></a>
                <a href="../functions/delete_watchlist.php?movie_id=' . $movie_id . '&title=' . $title . '" onclick="return confirm(\'Are you sure you want to delete ' . $title . ' from your watch list?\')"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a>';

                // close the search-result div
                echo '</div></div>';

              }
            }
            else{
              die("Movie Error");
            }
          }
        }
        else{
          die("Error");
        }

      ?>
    </div>
  </body>
</html>
