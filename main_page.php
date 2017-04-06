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

    </script>
  </head>
<body>
  <div class="container">
    <div class="row">
      <div class="main_page_title">
        <h1>Movie-DB</h1>
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
              <div class="col-xs-6 form-input">
                <input placeholder="Search" name="search" type="text">
              </div>
              <div class="col-xs-3 search-button">
                <input type="submit" name="submit" value="Search" class="databased-btn search-btn">
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
