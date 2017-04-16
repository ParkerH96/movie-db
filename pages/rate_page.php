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

    <!-- include fonts -->
    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/crew_page.css" type="text/css">
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/rate_page.css" type="text/css">

    <?php
      include '../functions/session.php';

      if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['search']) && isset($_GET['option']) && isset($_GET['sorting-option'])){
        $c_movie_id = $_GET['movie_id'];
        $search = $_GET['search'];
        $option = $_GET['option'];
        $sorting_option = $_GET['sorting-option'];
        $navigation = $_GET['navigated-from'];
        $search_flag = 1;
      }
      else if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['navigated-from'])){
        $c_movie_id = $_GET['movie_id'];
        $navigation = $_GET['navigated-from'];
        $search_flag = 0;
      }
      else{
        $_SESSION['status'] = 'Failure';
        $_SESSION['message'] = 'Request Failed. No movie data could be found. Please sarch for one first or select one from <a href="watchlist_page.php">Your Watchlist</a>';

        header("location: main_page.php");
      }

      $genre_list = '';
      if(isset($_GET['genre'])){
        $genre = $_GET['genre'];
        foreach($genre as $genre_value){
          if($genre_value != ''){
            $genre_list .= '&genre[]=';
            $genre_list .= $genre_value;
          }
        }
      }

      if(!empty($_POST['tag'])){
        header("location: ../functions/add_tag.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option$genre_list");
      }

      if(!empty($_POST['star']) && isset($_POST['star'])){

        //connect to the database
        include '../functions/connection.php';

    		//escape the strings
    		$review = $mysqli->escape_string($_POST['review']);
        $rating = $_POST['star'];

        /*if (isset($_POST['star']) && !empty($_POST['star'])) {
          $rating = $_POST['star'];
        } else {
          $_SESSION['status'] = 'Failure';
    		  $_SESSION['message'] = 'You must enter a rating before submitting!';
          //header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option&navigated-from=$navigation$genre_list");
        }*/

    		$insertion_query = $mysqli->query("INSERT INTO user_actions VALUES ($user_id, $c_movie_id, $rating, '$review')");

    		if($insertion_query){

    			 $_SESSION['status'] = 'Success';
    			 $_SESSION['message'] = 'Success! Your review has been added. Thank you for your feedback!';

    		  //success! redirect them back to the main page
    			 header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option&navigated-from=$navigation$genre_list");
    		}
    		else {
    		  die("Error.");
    		}
    	}
      else{
       //$_SESSION['status'] = 'Failure';
       //$_SESSION['message'] = 'You must enter a rating before submitting!';
       //header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option&navigated-from=$navigation$genre_list");
      }

    ?>
  </head>
<body>
  <div id="rate-page" class="container">
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
        <a href="../login.php"><button type="button" class="btn btn-danger logout">Logout</button></a>
      </div>
    </div>
    <div class= "row page-content">

      <!-- PHP for gathering all of the necessairy information about the movie to set up the page -->
      <?php
        include '../functions/connection.php';

        $movie_query = $mysqli->query("SELECT * FROM MOVIE WHERE movie_id = $c_movie_id");

        if($movie_query){

          $result = $movie_query->fetch_assoc();

          $c_title = $result['title'];
          $c_release_date = $result['release_date'];
          $c_summary = $result['summary'];
          $c_language = $result['language'];
          $c_duration = $result['duration'];
          $c_trailer = $result['trailer'];
          $c_poster = $result['poster'];

          $rating_query = $mysqli->query("SELECT AVG(rating) FROM user_actions WHERE movie_id=$c_movie_id");
          $rating_result = $rating_query->fetch_assoc();
          $c_rating = $rating_result['AVG(rating)'];
        }
      ?>
      <!-- **END movie information code -->

      <div class="col-sm-4 poster-container">
        <?php
          if($navigation == 'search'){
            echo '<a href="../pages/main_page.php?option=' . $option . '&sorting-option=' . $sorting_option . '&search=' . $search . '&submit=Search' . $genre_list . '"><button type="button" class="btn btn-default"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back to search results</button></a>';
          }
          else if($navigation == 'watchlist'){
            echo '<a href="../pages/watchlist_page.php"><button class="btn btn-success"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back to watch list</button></a>';
          }
          else if($navigation == 'home'){
            echo '<a href="../pages/watchlist_page.php"><button class="btn btn-info"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back to home page</button></a>';
          }
        ?>
        <br><br>
        <div class="well">
          <img class="poster" src="../images/posters/<?php echo $c_poster?>">
        </div>
        <div class="movie-rating">

          <!-- PHP for displaying the star rating underneath the movie poster -->
          <?php

            include '../functions/star_rating.php';
            displayStarRating($c_rating, 2);
            $rating_4char = substr($c_rating, 0, 4);
            echo "<h4>$rating_4char/10</h4>"
          ?>
          <!-- **END star rating -->

        </div>
        <h1>Tags:</h1>
        <div class="row tag-content">

        <!-- PHP for displaying the current tags in the database of the movie -->
        <?php
          $has_tags_query = $mysqli->query("SELECT * FROM has_tags WHERE movie_id = $c_movie_id");

          if($has_tags_query){

            while($has_tag_tuple = $has_tags_query->fetch_assoc()){
              $tag_id = $has_tag_tuple['tag_id'];

              $tag_query = $mysqli->query("SELECT * FROM TAGS WHERE tag_id=$tag_id");

              if($tag_query){

                $counter = 0;
                while($tag_tuple = $tag_query->fetch_assoc()){
                  $tag = $tag_tuple['tag'];
                  $counter++;

                  echo '<div class="tag col-xs-6"><button class="tag-btn btn btn-info">' . $tag . '</button></div>';

                }
              }

            }
          }
        ?>
        <!-- **END display tag code -->
        </div>

        <form method="post" action="../functions/add_tag.php">
          <input style="display: none" type="text" name="movie_id" value="<?php echo $c_movie_id ?>">
          <input style="display: none" type="text" name="navigated-from" value="<?php echo $navigation; ?>">
          <?php
            if($search_flag){
              //echo '<input type="text" name="genrelist" value"' . $genre_list .'">';
              echo '<input style="display: none" type="text" name="search" value="' . $search . '">';
              echo '<input style="display: none" type="text" name="option" value="' . $option . '">';
              echo '<input style="display: none" type="text" name="sorting-option" value="' . $sorting_option . '">';
            }
          ?>
          <div class="tag-form">
            <input class="tag-text" type="text" maxlength="16" name="tag" placeholder="Tag"><button class="btn btn-success" type="submit" name="submit"><span class="glyphicon glyphicon-plus"></span> Tag</button>
          </div>
        </form>

      </div>
      <div class="col-sm-8 movie-info">

        <!-- PHP for displaying the current session message for the alert system -->
        <?php
          if(!empty($message) && $status == 'Success'){
            echo '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
            $_SESSION['message'] = '';
          }
          else if(!empty($message) && $status == 'Failure'){
            echo '<br><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
            $_SESSION['message'] = '';
          }

        ?>
        <!-- **END Alert Code -->

        <h1><?php echo $c_title; ?></h1>
        <hr>
        <h4>
          <!-- list genres for the movie -->
          <?php
            $is_genres_query = $mysqli->query("SELECT * FROM is_genres WHERE movie_id = $c_movie_id");
            if ($is_genres_query) {
              $first = true;
              while ($is_genres_tuple = $is_genres_query->fetch_assoc()) {
                $g_id = $is_genres_tuple['genre_id'];
                $genre_query = $mysqli->query("SELECT * FROM GENRE WHERE genre_id = $g_id");
                if ($genre_tuple = $genre_query->fetch_assoc()) {
                  $c_genre = $genre_tuple['genre'];
                  if ($first) {
                    echo "$c_genre";
                    $first = false;
                  } else {
                    echo ", $c_genre";
                  }
                }
              }
            }
          ?>
        </h4>
        <div class="movie-description">
          <span><?php echo $c_release_date . ' ‧ ' . $c_duration; ?></span><br><br>
          <span>&emsp;<?php echo $c_summary?></span><br><br>
        </div>
        <div class="crew-info">
          <?php
            $has_crew_query = $mysqli->query("SELECT * FROM has_crew WHERE movie_id = $c_movie_id");
            if ($has_crew_query) {
              // echo "<h3>Crews:</h3>";
              // for each crew associated with the given movie
              while ($has_crew_tuple = $has_crew_query->fetch_assoc()) {
                $c_crew_id = $has_crew_tuple['crew_id'];
                $crew_query = $mysqli->query("SELECT * FROM CREW WHERE crew_id = $c_crew_id");
                if ($crew_tuple = $crew_query->fetch_assoc()) {
                  $c_crew_name = $crew_tuple['name'];

                  echo '<div class="crew-result"><div class="btn-info crew-result-title">Crew</div><div class="crew-result-content"><br>';

                  //for each member in the crew
                  $has_members_query = $mysqli->query("SELECT * FROM has_members WHERE crew_id = $c_crew_id");
                  while ($has_members_tuple = $has_members_query->fetch_assoc()) {
                    $c_role_id = $has_members_tuple['role_id'];
                    $c_mem_id = $has_members_tuple['mem_id'];

                    //find the info on the role and member
                    $member_query = $mysqli->query("SELECT * FROM MEMBER WHERE mem_id = $c_mem_id");
                    $role_query = $mysqli->query("SELECT * FROM ROLE WHERE role_id = $c_role_id");

                    if($member_query && $role_query){
                      $c_member = $member_query->fetch_assoc();
                      $c_role = $role_query->fetch_assoc();

                      $mem_first_name = $c_member['first_name'];
                      //$mem_middle_name = $c_member['middle_name'];
                      $mem_last_name = $c_member['last_name'];
                      //$mem_dob = $c_member['dob'];
                      //$mem_gender = $c_member['gender'];

                      $role = $c_role['role'];

                      echo $mem_first_name . ' ' . $mem_last_name . ' - ' . $role . '<br>';
                    }
                  }
                  echo '</div><br></div><br>';
                }
              }
            }

          ?>
        </div>
        <div class="responsive-iframe">
          <img class="ratio" src="http://placehold.it/16x9"/>
          <iframe src="<?php echo $c_trailer?>" frameborder="0" allowfullscreen></iframe>
        </div>

        <!-- PHP that lays out all of the current reviews for a given movie -->
        <?php
          //review query that gathers all of the data from user_actions on a given movie id
          $review_query = $mysqli->query("SELECT * FROM user_actions WHERE movie_id = $c_movie_id");

          if($review_query){

            if ($review_query->num_rows > 0) {
              echo '<h2>User Reviews:</h2>';
            }

            while($current_row = $review_query->fetch_assoc()){
              $i_user_id = $current_row['user_id'];
              $i_rating = $current_row['rating'];
              $i_review = $current_row['review'];

              $user_query = $mysqli->query("SELECT * FROM USER WHERE user_id=$i_user_id");

              if($user_query){
                $c_user = $user_query->fetch_assoc();
                $i_first_name = $c_user['first_name'];
                $i_last_name = $c_user['last_name'];
              }
              else{
                die("Error");
              }

              include_once '../functions/display_user_review.php';
              displayUserReview($i_first_name, $i_last_name, $i_rating, $i_review);
              // echo $i_first_name . ' ' . $i_last_name . '<br>' . $i_rating . '<br>' . $i_review . '<br>';
            }
          }
          else{
            die("Error");
          }
        ?>
        <!-- **END User Reviews -->

        <h2>Leave a Rating/Review:</h2>
        <div class="well movie-feedback">
          <form method="post" action="">
            <!-- <input type="number" min="0" max="10" name="rating" required><br> -->
            <!-- http://www.cssscript.com/simple-5-star-rating-system-with-css-and-html-radios/ -->
            <div class="stars">
              <input class="star star-5" value="10" id="star-5" type="radio" name="star"/>
              <label class="star star-5" for="star-5"></label>
              <input class="star star-4" value="8" id="star-4" type="radio" name="star"/>
              <label class="star star-4" for="star-4"></label>
              <input class="star star-3" value="6" id="star-3" type="radio" name="star"/>
              <label class="star star-3" for="star-3"></label>
              <input class="star star-2" value="4" id="star-2" type="radio" name="star"/>
              <label class="star star-2" for="star-2"></label>
              <input class="star star-1" value="2" id="star-1" type="radio" name="star"/>
              <label class="star star-1" for="star-1"></label>
            </div>
            <textarea class="text-input" name="review" rows="4"></textarea><br>
            <button type="submit" name="submit" class="btn btn-info">Rate Now</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
