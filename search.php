<?php
      if(!empty($_GET['search'])){

        include 'connection.php';

        //escape the strings
        $search_key = $mysqli->escape_string($_GET['search']);

        if($_GET['option'] === 'Any'){

        }
        else {
          if($_GET['option'] === 'Title'){

            $search_query = $mysqli->query("SELECT * FROM MOVIE WHERE title LIKE '%" . "$search_key" . "%'");

          }
          else if($_GET['option'] === 'Genre'){



          }

          if($search_query){

            echo $search_query->num_rows . ' results found.<br><br>';
            while($current_row = $search_query->fetch_assoc()){
              $title = $current_row['title'];
              $release_date = substr($current_row['release_date'], 0, 4);
              $summary = $current_row['summary'];
              $language = $current_row['language'];
              $duration = $current_row['duration'];

              echo $title . '<br>' . $release_date . ' ‧ ' . $duration . '<br>' . $summary . '<br><br>';
            }
          }
          else{
            die('Error');
          }
        }
      }
?>
