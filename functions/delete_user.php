<?php
  include 'connection.php';

  if(isset($_GET['user_id']) && !empty($_GET['user_id'])){

    //escape the string
    $c_user_id = $mysqli->escape_string($_GET['user_id']);

    $delete_user_actions = $mysqli->query("DELETE FROM user_actions WHERE user_id = $c_user_id");
    $delete_user = $mysqli->query("DELETE FROM USER WHERE user_id = $c_user_id");

    if($delete_user && $delete_user_actions){
      header("location: ../pages/users_page.php");
    }
    else{
      die("Error.");
    }
  }
?>
