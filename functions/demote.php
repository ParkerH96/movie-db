<?php
  include 'connection.php';

  if(isset($_GET['user_id']) && !empty($_GET['user_id'])){

    //escape the string
    $c_user_id = $mysqli->escape_string($_GET['user_id']);

    $update_query = $mysqli->query("UPDATE USER SET admin_tag=0 WHERE user_id = $c_user_id");

    if($update_query){
      header("location: ../pages/users_page.php");
    }
    else{
      die("Error.");
    }
  }
?>
