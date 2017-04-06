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
      include 'session.php';

      //makes sure no one can access this page if they are not a manager
      if($_SESSION['admin_tag'] != 1){
        header("location: main_page.php");
      }

      if(!empty($_POST)){

        //connect to the database
        include 'connection.php';

        //translate the form inputs into php variables
        $title = $mysqli->escape_string($_POST['title']);
        $release_date = $mysqli->escape_string($_POST['release_date']);
        $summary = $mysqli->escape_string($_POST['summary']);
        $language = $mysqli->escape_string($_POST['language']);
        $duration = $mysqli->escape_string($_POST['duration']);

        //create the insertion query using the form data
        $insertion_query = $mysqli->query("INSERT INTO MOVIE(title, release_date, summary, language, duration) VALUES ('$title', '$release_date', '$summary', '$language', '$duration')");

        if($insertion_query){
          header("location: main_page.php");
        }
        else{
          die("Error...");
        }
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
        <strong><?php echo $first_name . ' ' . $last_name; ?></strong>
        <?php
          if($admin_tag == 1){
            echo
             '<div class="dropdown">
              <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
              Manager
              <span class="caret"></span></button>
              <ul class="dropdown-menu">
                <li><a href="add_page.php">Add a Movie</a></li>
                <li><a href="#">Delete a Movie</a></li>
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
    <div class= "row page-content">
      <div class="container">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-xs-12 col-md-6 add-form">
            <img src="https://cdn4.iconfinder.com/data/icons/IMPRESSIONS/multimedia/png/400/video.png"></img>
            <form method="post" action="">
              <input type="text" name="title" placeholder="Movie Title"><br>
              <input type="date" name="release_date"><br>
              <textarea name="summary" rows="4" cols="50" placeholder="Enter text..."></textarea><br>
              <input type="text" name="language" placeholder="Language"><br>
              <input type="text" name="duration" placeholder="hh:mm:ss"><br>
              <input class="databased-btn" type="submit" name="submit" value="Add Movie">
            </form>
          </div>
          <div class="col-md-3"></div>
        </div>
      </div>
    </div>
  </body>
</html>
