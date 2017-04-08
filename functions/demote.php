<?php
  include 'connection.php';
  include 'session.php';

  if(isset($_GET['user_id']) && !empty($_GET['user_id'])){

    //escape the string
    $c_user_id = $mysqli->escape_string($_GET['user_id']);

    $update_query = $mysqli->query("UPDATE USER SET admin_tag=0 WHERE user_id = $c_user_id");

    if($update_query){

      $result = $mysqli->query("SELECT first_name, middle_name, last_name FROM USER WHERE user_id = $c_user_id");
      $current_row = $result->fetch_assoc();

      $c_first_name = $current_row['first_name'];
      $c_middle_name = $current_row['middle_name'];
      $c_last_name = $current_row['last_name'];

      $_SESSION['message'] = 'Success! ' . $c_first_name . ' ' . $c_middle_name . ' ' . $c_last_name . ' was demoted to a User.';
      $_SESSION['status'] = 'Success';

      header("location: ../pages/users_page.php");
    }
    else{
      die("Error.");
    }
  }
?>
