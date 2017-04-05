<html>
  <head>

  </head>
  <body>
    <form method="get" action="">
      <input type="text" name="search"><br>
      <select name="option">
        <option>Any</option>
        <option>Title</option>
        <option>Genre</option>
        <option>Tag</option>
        <option>Crew</option>
      </select>
      <input type="submit" name="submit" value="Search">

    </form>
    <?php
      if(!empty($_GET['search'])){

        include 'connection.php';

        //escape the strings
        $search_key = $mysqli->escape_string($_GET['search']);

        if($_GET['option'] === 'Title'){

          $search_query = $mysqli->query("SELECT * FROM MOVIE WHERE title LIKE '%" . "$search_key" . "%'");

          if($search_query){
            while($current_row = $search_query->fetch_assoc()){
              $title = $current_row['title'];
              $release_date = substr($current_row['release_date'], 0, 4);
              $summary = $current_row['summary'];
              $language = $current_row['language'];
              $duration = $current_row['duration'];

              echo $title . '<br>' . $release_date . ' ‧ ' . $duration . '<br>' . $summary . '<br><br';
            }
          }
          else{
            die('Error');
          }
        }
      }
    ?>
  </body>
</html>
