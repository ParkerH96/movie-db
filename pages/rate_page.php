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
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/rate_page.css" type="text/css">

    <?php
      include '../functions/session.php';

      if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['search']) && isset($_GET['option']) && isset($_GET['sorting-option'])){
        $c_movie_id = $_GET['movie_id'];
        $search = $_GET['search'];
        $option = $_GET['option'];
        $sorting_option = $_GET['sorting-option'];
      }
      else {

        //$_SESSION['message'] = 'Request Failed. You must first search for a movie in which you wish to rate!';
        //$_SESSION['status'] = 'Failure';
        header("location: main_page.php");
      }

      if(!empty($_POST)){

        //connect to the database
        include '../functions/connection.php';

    		if (!isset($_POST['add_tag'])) {
    			//escape the strings
    			$review = $mysqli->escape_string($_POST['review']);

          if (isset($_POST['star'])) {
            $rating = $_POST['star'];
          } else {
            $_SESSION['status'] = 'Failure';
    			  $_SESSION['message'] = 'You must enter a rating before submitting!';
            header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option");
          }

    			$insertion_query = $mysqli->query("INSERT INTO user_actions VALUES ($user_id, $c_movie_id, $rating, '$review')");

    			if($insertion_query){

    			  $_SESSION['status'] = 'Success';
    			  $_SESSION['message'] = 'Success! Your review has been added. Thank you for your feedback!';

    			  //success! redirect them back to the main page
    			  header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option");
    			}
    			else {
    			  die("Error.");
    			}
    		}
    		else {
    			//escape the strings
    			$tag = $mysqli->escape_string($_POST['add_tag']);


    			//Figure out our tag id
    			$tag_query = $mysqli->query("SELECT * FROM TAGS WHERE tag = '$tag'");
    			if ($tag_query) {
    				$result = $tag_query->fetch_assoc();
    				$tag_id = $result['tag_id'];

    				$insertion_query = $mysqli->query("INSERT INTO has_tags VALUES ($tag_id, $c_movie_id)");

    				if($insertion_query){

    					$_SESSION['status'] = 'Success';
    					$_SESSION['message'] = 'Success! Your tag has been added. Thank you for your feedback!';

    					//success! redirect them back to the main page
    					header("location: rate_page.php?movie_id=$c_movie_id&search=$search&option=$option&sorting-option=$sorting_option");
    				}
    				else {
    				  die("Error. insertion query failed");
    				}
    			}
    			else{
    				//We didn't find the tag in TAGS
    				$_SESSION['status'] = 'Failed';
    				$_SESSION['message'] = 'Sorry! Your tag is not a valid tag. Try again!';
    			}
    		}
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
      <div class="col-sm-4 poster-container">
        <a href="<?php echo "../pages/main_page.php?option=$option&sorting-option=$sorting_option&search=$search&submit=Search";?>"><button type="button" class="btn btn-default"><i class="fa fa-arrow-circle-o-left" aria-hidden="true"></i> Back to search results</button></a>
        <br><br>
        <div class="well">
          <img class="poster" src="../images/posters/<?php echo $c_poster?>">
        </div>
        <div class="movie-rating">
          <?php

            include '../functions/star_rating.php';
            displayStarRating($c_rating, 2);
            $rating_4char = substr($c_rating, 0, 4);
            echo "<h4>$rating_4char/10</h4>"
          ?>
        </div>
        <br>
		<div class="tags">
		<h2> Tags </h2> <br>
		<?php
			include '../functions/tags.php';
			include '../functions/connection.php';
			$movie_id = $_GET['movie_id'];
			$movie_query = $mysqli->query("SELECT * FROM MOVIE WHERE movie_id = $movie_id");
			$result = $movie_query->fetch_assoc();
			$movie_title = $result['title'];
			displayTags($movie_title);
		?>
		</div>
		<br><br>
		Add tag: <br>
        <form action = "" method="post">
			<input type="text" name="add_tag"><br>
			<input type="submit" value="Submit">
		</form>
      </div>
      <div class="col-sm-8 movie-info">
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
        <h1><?php echo $c_title; ?></h1>
        <div class="movie-description">
          <span><?php echo $c_release_date . ' ‧ ' . $c_duration; ?></span><br>
          <span>&emsp;<?php echo $c_summary?></span>
        </div>
        <div class="responsive-iframe">
          <img class="ratio" src="http://placehold.it/16x9"/>
          <iframe src="<?php echo $c_trailer?>" frameborder="0" allowfullscreen></iframe>
        </div>
        <?php
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
            <textarea name="review" rows="4" cols="50"></textarea><br>
            <button type="submit" class="btn btn-info">Rate Now</button>
          </form>
        </div>
      </div>
    </div>
  </body>
</html>
