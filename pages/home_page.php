<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, Evan Heaton

  Name: home_page.php

  Description: This file contains the main HTML code used for laying out the landing page
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
    <link rel="stylesheet" href="../css/home_page.css" type="text/css">

    <?php
      include '../functions/session.php';
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

      <div class="row photobanner-container">

        <div class="photobanner">
          <img class="poster first" src="../images/posters/40yo-virgin.jpg">
          <img class="poster" src="../images/posters/divergent.jpg">
          <img class="poster" src="../images/posters/fight-club.jpg">
          <img class="poster" src="../images/posters/force-awakens.jpg">
          <img class="poster" src="../images/posters/frank.jpg">
          <img class="poster" src="../images/posters/guardians.jpg">
          <img class="poster" src="../images/posters/her.jpg">
          <img class="poster" src="../images/posters/inception.jpg">
          <img class="poster" src="../images/posters/interstellar.jpg">
          <img class="poster" src="../images/posters/jaws.jpg">
          <img class="poster" src="../images/posters/jurassic-park.jpg">
          <img class="poster" src="../images/posters/titanic.jpg">
          <img class="poster" src="../images/posters/40yo-virgin.jpg">
          <img class="poster" src="../images/posters/divergent.jpg">
          <img class="poster" src="../images/posters/fight-club.jpg">
          <img class="poster" src="../images/posters/force-awakens.jpg">
          <img class="poster" src="../images/posters/frank.jpg">
          <img class="poster" src="../images/posters/guardians.jpg">
          <img class="poster" src="../images/posters/her.jpg">
        </div>

      </div>
      <div class="row info">
        <h1>Welcome to Movie-DB!</h1>
        <div class="col-sm-6">Movie-DB is a large database of popular movies, complete with searchable information on each movie. Crews, Producers, and Actors for each movie are saved on the database, as well as release dates and movie lengths. </div>
        <div class="col-sm-6">As a user, you have the ability to rate and leave comments on movies that you have watched. Help improve our database by leaving feedback on your favorite movies! To begin your search in the database, click the button below. </div>
      </div>
      <div class="row search">
        <h3>Search!</h3>
        <a href="main_page.php"><button type="button" class="btn btn-primary search-button"><span class="glyphicon glyphicon-search"></span></button></a>
      </div>

    </div>
  </body>
</html>
