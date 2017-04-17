<?php
include 'connection.php';

if(!empty($_POST)){
  $crew = $mysqli->escape_string($_POST['crew_select']);
  $member = $mysqli->escape_string($_POST['member_select']);
  $role = $mysqli->escape_string($_POST['role_select']);

  $insertion_query = $mysqli->query("INSERT INTO has_members VALUES ($crew, $member, $role)");

  if($insertion_query){

    $temp_crew_query = $mysqli->query("SELECT * FROM CREW WHERE crew_id=$crew");
    $temp_crew = $temp_crew_query->fetch_assoc();
    $temp_crew_name = $temp_crew['name'];

    $temp_mem_query = $mysqli->query("SELECT * FROM MEMBER WHERE mem_id=$member");
    $temp_mem = $temp_mem_query->fetch_assoc();
    $temp_mem_first_name = $temp_mem['first_name'];
    $temp_mem_last_name = $temp_mem['last_name'];

    /*$_SESSION['status'] = 'Success';
    $_SESSION['message'] = 'Success! ' . $temp_mem_first_name . ' ' . $temp_mem_last_name . ' was added to ' . $temp_crew_name . '!';
    */
    header("location: ../pages/crews_page.php");
  }

}
?>
