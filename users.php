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
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/main_page.css" type="text/css">
    <link rel="stylesheet" href="css/add_page.css" type="text/css">

    <?php

      include 'session.php'

    ?>
  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>Movie-DB</h1>
      </div>
      <div id="tool-bar">
        <strong><?php echo $first_name . ' ' . $last_name; ?></strong>
        <?php
          if($admin_tag == 1){
            echo
             '<div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
              Manager
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="users.php">View Users</a></li>
                <li><a href="add_page.php">Add a Movie</a></li>
                <li><a href="#">Edit a Movie</a></li>
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
          <span class="caret"></span></button>
          <ul class="dropdown-menu">
             <li><a href="main_page.php">Search Movies</a></li>
             <li><a href="#">Tag a Movie</a></li>
             <li><a href="#">Rate and comment</a></li>
          </ul>
        </div>
        <button type="button" class="btn btn-danger"><a href="login.php">Logout</a></button>
      </div>
    </div>
    <div class="row page-content">
      <?php
        include 'connection.php';

        $users = $mysqli->query("SELECT * FROM USER");

        if($users){

          while($current_row = $users->fetch_assoc()){
            $user_id = $current_row['user_id'];
            $admin_tag = $current_row['admin_tag'];
            $first_name = $current_row['first_name'];
            $middle_name = $current_row['middle_name'];
            $last_name = $current_row['last_name'];
            $dob = $current_row['dob'];
            $gender = $current_row['gender'];

            echo '<div class="search-result"><h3>' . $first_name . ' ' . $middle_name . ' ' . $last_name . '</h3></div>';
          }

        }
        else{
          die("Error.");
        }
      ?>
    </div>

  </body>
</html>
