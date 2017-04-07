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

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">
    <link rel="stylesheet" href="../css/add_page.css" type="text/css">

    <?php
      include '../functions/session.php';

      //makes sure no one can access this page if they are not a manager
      if($_SESSION['admin_tag'] != 1){
        header("location: main_page.php");
      }

      if(isset($_GET['movie_id']) && !empty($_GET['movie_id']) && isset($_GET['title']) && !empty($_GET['title']) && isset($_GET['summary']) && !empty($_GET['summary']) && isset($_GET['language']) && !empty($_GET['language'])){
        $c_title = $_GET['title'];
        $c_release_date = $_GET['release_date'];
        $c_summary = $_GET['summary'];
        $c_language = $_GET['language'];
        $c_duration = $_GET['duration'];
      }
      else {
        header("location: main_page.php");
      }

      if(!empty($_POST)){

        //connect to the database
        include '../functions/connection.php';

        //translate the form inputs into php variables
        $title = $mysqli->escape_string($_POST['title']);
        $release_date = $mysqli->escape_string($_POST['release_date']);
        $summary = $mysqli->escape_string($_POST['summary']);
        $language = $mysqli->escape_string($_POST['language']);
        $duration = $mysqli->escape_string($_POST['duration']);
        $movie_id = $mysqli->escape_string($_GET['movie_id']);

        //create the insertion query using the form data
        $update_query = $mysqli->query("UPDATE MOVIE SET title='$title', release_date='$release_date', summary='$summary', language='$language', duration='$duration' WHERE movie_id=$movie_id");

        if($update_query){
          header("location: main_page.php");
        }
        else{
          die("Error...");
        }

        //Close the connection to the database
        $mysqli->close();
      }

    ?>
  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>Movie-DB</h1>
      </div>
      <div id="tool-bar">
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
                  <li><a href="add_page.php">Add a Movie</a></li>
                  <li><a href="#">Add a Crew</a></li>
                  <li><a href="#">Delete a Crew</a></li>
                  <li><a href="#">Edit a Crew</a></li>
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
             <li><a href="#">Tag a Movie</a></li>
             <li><a href="#">Rate and comment</a></li>
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
              <input type="text" name="title" value="<?php echo $c_title;?>"><br>
              <input type="date" name="release_date" value="<?php echo $c_release_date;?>"><br>
              <textarea name="summary" rows="4" cols="50"><?php echo $c_summary;?></textarea><br>
              <input type="text" name="language" value="<?php echo $c_language;?>"><br>
              <input type="text" name="duration" value="<?php echo $c_duration;?>"><br>
              <input class="databased-btn" type="submit" name="submit" value="Update Movie">
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </div>
  </body>
</html>
