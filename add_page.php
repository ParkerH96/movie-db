<!DOCTYPE html>
<html>
  <head>
    <title> Add a Movie! </title>
    <meta charset="UTF-8">
    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/add_page.css" type="text/css">

    <script type="text/javascript">



    </script>





    <?php



    ?>

  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="add_movie_title">
          <h1> Add a Movie </h1>
        </div>
      </div>
      <div class="row page-content">
        <form method="get" action="">
          <div class="row">
            <span class="small-title">Title:</span><br></br>
            <input placeholder="" name="title" type="text">
          </row>
          <div class="row">
            <span class="small-title">Release Date:</span><br></br>
            <input placeholder="mm/dd/yyyy" name="release_date" type="text">
          </div>
          <div class="row">
            <span class="small-title">Summary:</span><br></br>
            <input placeholder="" name="summary" type="text">
          </div>
          <div class="row">
            <span class="small-title">Language:</span><br></br>
            <input placeholder="" name="language" type="text">
          </div>
          <div class="row">
            <span class="small-title">Duration:</span><br></br>
            <input placeholder="hh:mm:ss" name="duration" type="text">
          </div>
          <div>
            <input type="submit" name="submit" value="Search" class="databased-btn search-btn">
          </div>
        </form>
