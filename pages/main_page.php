<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, Evan Heaton, Jonathan Dingess, David Cottrell

  Name: main_page.php

  Description: This file contains the main HTML code used for laying out the main
  search page.
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
    <div class= "row page-content">
      <div class = "col-sm-3">
        <h1> Genres </h1>
        <!--<ul>
          <li> Animated </li>
          <li> Romance </li>
          <li> Comedy </li>
          <li> Action </li>
          <li> Drama </li>
          <li> Horror </li>
        </ul>-->
        <input type="checkbox" name="genre1" value="Animated"> Animated<br>
        <input type="checkbox" name="genre2" value="Romance"> Romance<br>
        <input type="checkbox" name="genre3" value="Comedy"> Comedy<br>
        <input type="checkbox" name="genre4" value="Action"> Action<br>
        <input type="checkbox" name="genre5" value="Drama"> Drama<br>
        <input type="checkbox" name="genre6" value="Horror"> Horror<br>
      </div>
        <div class="col-sm-9 search-window">
          <div class="row search-bar">
            <form method="get" action="">
              <div class="col-xs-3 search-options">
                <span class="small-title">Search By:</span>
                <select name="option">
                  <option>Any</option>
                  <option>Title</option>
                  <option>Genre</option>
                  <option>Tag</option>
                  <option>Crew</option>
                </select>
              </div>
              <div class="col-xs-9 form-input">
                <div class="text-and-button">
                  <input placeholder="Search" name="search" type="text">
                  <input type="submit" name="submit" value="Search" class="databased-btn search-btn">
                </div>
              </div>
            </form>
          </div>
          <div class="row results-row">
            <h1> Results: </h1>
            <?php

              include '../functions/search.php';

             ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
