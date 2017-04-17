<?php
include 'connection.php';

if(!empty($_GET)){
  $crew = $mysqli->escape_string($_GET['crew_id']);
  $member = $mysqli->escape_string($_GET['mem_id']);
  $role = $mysqli->escape_string($_GET['role_id']);

  $deletion_query = $mysqli->query("DELETE FROM has_members WHERE crew_id=$crew AND mem_id=$member AND role_id=$role");

  header("location: ../pages/crews_page.php");
}
?>
