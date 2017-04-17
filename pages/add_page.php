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
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">
    <link rel="stylesheet" href="../css/add_page.css" type="text/css">

    <?php
      include '../functions/session.php';
      //connect to the database
      include '../functions/connection.php';

      //makes sure no one can access this page if they are not a manager
      if($_SESSION['admin_tag'] != 1){

        $_SESSION['message'] = 'Request Failed. You do not have permission to view that page!';
        $_SESSION['status'] = 'Failure';

        header("location: main_page.php");
      }

      if(!empty($_POST)){



        //translate the form inputs into php variables
        $title = $mysqli->escape_string($_POST['title']);
        $genre_id = $mysqli->escape_string($_POST['genre_select']);
        $release_date = $mysqli->escape_string($_POST['release_date']);
        $summary = $mysqli->escape_string($_POST['summary']);
        $language = $mysqli->escape_string($_POST['language']);
        $duration = $mysqli->escape_string($_POST['duration']);
        $trailer = $mysqli->escape_string($_POST['trailer']);
        $poster = $mysqli->escape_string($_POST['poster']);

        //create the insertion query using the form data
        $insertion_query = $mysqli->query("INSERT INTO MOVIE(title, release_date, summary, language, duration, trailer, poster) VALUES ('$title', '$release_date', '$summary', '$language', '$duration', '$trailer', '$poster')");

        if($insertion_query){

          // http://php.net/manual/en/function.mysql-insert-id.php
          $movie_id = mysqli_insert_id($mysqli);
          echo $movie_id;

          // assign the genre
          $is_genres_query = $mysqli->query("INSERT INTO is_genres(movie_id, genre_id) VALUES ('$movie_id', '$genre_id')");

          if ($is_genres_query) {
            $_SESSION['message'] = 'Success! ' . $title . ' was added to the database!';
            $_SESSION['status'] = 'Success';

            header("location: main_page.php");
          } else {
            die("Error assigning genre");
          }
        }
        else{
          die("Error inserting movie");
        }
      }

    ?>
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
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-xs-12 col-md-6 add-form">
            <img src="https://cdn4.iconfinder.com/data/icons/IMPRESSIONS/multimedia/png/400/video.png"></img>
            <form method="post" action="">
              <input type="text" name="title" placeholder="Movie Title"><br>
              <select name="genre_select">
                <?php
                  $genres_query = $mysqli->query("SELECT * FROM GENRE");
                  while ($genres_tuple = $genres_query->fetch_assoc()) {
                    $i_genre = $genres_tuple['genre'];
                    $i_genre_id = $genres_tuple['genre_id'];
                    echo '<option value="' . $i_genre_id .'">' . $i_genre . '</option>';
                  }
                ?>
              </select><br>
              <input type="date" name="release_date"><br>
              <textarea name="summary" rows="4" cols="50" placeholder="Enter summary..."></textarea><br>
              <input type="text" name="language" placeholder="Language"><br>
              <input type="text" name="duration" placeholder="hh:mm:ss"><br>
              <input type="text" name="trailer" placeholder="Trailer"><br>
              <input type="text" name="poster" placeholder="Poster"><br>
              <input class="databased-btn" type="submit" name="submit" value="Add Movie">
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </div>
  </body>
</html>
