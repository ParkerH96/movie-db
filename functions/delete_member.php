<?php
  include 'connection.php';
  include 'session.php';

  $mem_id = $mysqli->escape_string($_POST['member_select_delete']);

  $delete_has_members = $mysqli->query("DELETE FROM has_members WHERE mem_id=$mem_id");
  $delete_query = $mysqli->query("DELETE FROM MEMBER WHERE mem_id=$mem_id");

  if($delete_query){

    $_SESSION['status'] = 'Success';
    $_SESSION['message'] = 'Success! The member was deleted from the database.';

    header("location: ../pages/crews_page.php");
  }
?>
