<?php
include 'connection.php';

if(!empty($_POST)){
  $crew = $mysqli->escape_string($_POST['crew_select']);
  $member = $mysqli->escape_string($_POST['member_select']);
  $role = $mysqli->escape_string($_POST['role_select']);

  $deletion_query = $mysqli->query("DELETE FROM has_members WHERE crew_id=$crew AND mem_id=$member AND role_id=$role");

}
?>
