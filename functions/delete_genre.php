<!-- Delete Genre
Author: Evan Heaton -->

<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['genre_id']) && !empty($_GET['genre_id'])) {

    $genre_id = $_GET['genre_id'];

    $delete_is_genres = $mysqli->query("DELETE FROM is_genres WHERE genre_id = $genre_id");
    $delete_genre = $mysqli->query("DELETE FROM GENRE WHERE genre_id = $genre_id");

    if($delete_genre && $delete_is_genres){

      $_SESSION['message'] = 'Success! The Genre was deleted from the database.';
      $_SESSION['status'] = 'Success';

      header("location: ../pages/main_page.php");

    } else {
      die('Error: Genre couldn\'t be deleted');
    }
  }
?>
