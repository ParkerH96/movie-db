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
    <link rel="stylesheet" href="../css/users_page.css" type="text/css">

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
    <div class="row page-content">
      <?php
        include '../functions/connection.php';

        //makes sure no one can access this page if they are not a manager
        if($admin_tag != 1){

          $_SESSION['message'] = 'Request Failed. You do not have permission to view that page!';
          $_SESSION['status'] = 'Failure';

          header("location: main_page.php");
        }

        $users = $mysqli->query("SELECT * FROM USER ORDER BY USER.admin_tag DESC");

        if(!empty($message) && $status == 'Success'){
          echo '<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
          $_SESSION['message'] = '';
        }
        else if(!empty($message) && $status == 'Failure'){
          echo '<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
          $_SESSION['message'] = '';
        }

        if($users){

          while($current_row = $users->fetch_assoc()){
            $i_user_id = $current_row['user_id'];
            $i_username = $current_row['username'];
            $i_admin_tag = $current_row['admin_tag'];
            $i_first_name = $current_row['first_name'];
            $i_middle_name = $current_row['middle_name'];
            $i_last_name = $current_row['last_name'];
            $i_dob = $current_row['dob'];
            $i_gender = $current_row['gender'];

            echo '<div class="user-result">';

            if ($i_admin_tag) {
              echo '<div class="user-result-title btn-primary">Manager</div>';
            } else {
              echo '<div class="user-result-title btn-success">User</div>';
            }

            echo '  <div class="user-result-content">
                      <h3>' . $i_first_name . ' ' . $i_middle_name . ' ' . $i_last_name . '</h3>
                      <h4>Username: <em>' . $i_username . '</em></h4>
                      <h4>Gender: <em>' . $i_gender . '</em></h4>
                      <h4>Date of Birth: <em>' . $i_dob . '</em></h4>
                  ';
            if ($i_user_id == $user_id) {
              echo '<strong class="logged-in">(Your Account)</strong>';
            } else {
              echo '<a href="../functions/delete_user.php?user_id=' . $i_user_id . '"><button type="button" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></button></a> ';
              if (!$i_admin_tag) {
                echo '<a href="../functions/promote.php?user_id=' . $i_user_id . '"><button type="button" class="btn btn-primary"><span class="glyphicon glyphicon-collapse-up"></span> Promote</button></a>';
              } else {
                echo '<a href="../functions/demote.php?user_id=' . $i_user_id . '"><button type="button" class="btn btn-warning"><span class="glyphicon glyphicon-collapse-down"></span> Demote</button></a>';
              }
            }
            echo '</div></div>';
          }

        }
        else{
          die("Error.");
        }
      ?>
    </div>

  </body>
</html>
