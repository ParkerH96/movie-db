<!DOCTYPE html>
<html>
  <head>
    <title> Movie-db </title>
    <meta charset="UTF-8">

    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/main_page.css" type="text/css">

    <script type="text/javascript">

    <?php
      //creates a session for storing data across pages
      session_start();

      if($_SESSION['logged_in'] != true){
        header("location: login.php");
      }
      else {
        $first_name = $_SESSION['first_name'];
        $middle_name = $_SESSION['middle_name'];
        $last_name = $_SESSION['last_name'];
        $admin_tag = $_SESSION['admin_tag'];

      }
    ?>

    </script>
  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>Movie-DB</h1>
      </div>
      <div id="tool-bar">
        <strong><?php echo 'Hi ' . $first_name; ?></strong>
        <?php
          if($admin_tag == 1){
            echo '<a href="add_page.php">Add a Movie</a>';
          }
        ?>
        <a style="float: right;" href="login.php">Logout</a>
      </div>
    </div>
    <div class= "row page-content">
      <div class = "col-sm-4">
        <h1> Genres </h1>
        <ul>
          <li> Animated </li>
          <li> Romance </li>
          <li> Comedy </li>
          <li> Action </li>
          <li> Drama </li>
          <li> Horror </li>
        </ul>
      </div>
        <div class="col-sm-8 search-window">
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

              include 'search.php';

             ?>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
