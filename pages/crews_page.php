<!--
  Team Databased 2017: Movie-DB
  Author(s): Parker Householder, David Cottrell

  Name: add_page.php

  Description: This file contains the PHP code used for adding a MOVIE into the
  database. It also contains the main HTML code for laying out the Add a Movie page.

-->
<!DOCTYPE html>
<html>
  <head>
    <title> Movie-db </title>
    <meta charset="UTF-8">

    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link href="https://fonts.googleapis.com/css?family=Didact+Gothic" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link rel="stylesheet" href="../fonts/font-awesome/css/font-awesome.min.css">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="../css/main.css" type="text/css">
    <link rel="stylesheet" href="../css/main_page.css" type="text/css">
    <link rel="stylesheet" href="../css/crew_page.css" type="text/css">

    <?php

      include '../functions/session.php';

    ?>
    <script type="text/javascript">
      function toggle(className){
        var x = document.getElementById(className);
        if (x.style.display === 'none') {
            x.style.display = 'block';
        } else {
            x.style.display = 'none';
        }
      }
    </script>
  </head>
<body>
  <div class="container">
    <div class="row shadow">
      <div class="main-page-title">
        <h1>
          <i class="fa fa-star" aria-hidden="true"></i>
          Movie-DB
          <i class="fa fa-star" aria-hidden="true"></i>
        </h1>
      </div>
      <div id="tool-bar">
        <a href="home_page.php"><button class="btn btn-info"><i class="fa fa-home" aria-hidden="true"></i></button></a>
        <?php
          if($admin_tag == 1){
            echo
             '<div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
                  Manager
                  <span class="caret"></span>
                </button>
                <ul class="dropdown-menu">
                  <li><a href="users_page.php">View Users</a></li>
                  <li><a href="crews_page.php">View Crews</a></li>
                  <li><a href="add_page.php">Add a Movie</a></li>
                </ul>
              </div>';
          }
        ?>
        <div class="dropdown">
          <button class="btn btn-success dropdown-toggle" type="button" data-toggle="dropdown">
            User
            <span class="caret"></span>
          </button>
          <ul class="dropdown-menu">
             <li><a href="main_page.php">Search Movies</a></li>
             <li><a href="watchlist_page.php">My Watchlist</a><li>
          </ul>
        </div>
        <span class="greeting"><?php echo 'Hello, ' . $first_name . ' ' . $last_name; ?></span>
        <button type="button" class="btn btn-danger logout"><a href="../login.php">Logout</a></button>
      </div>
    </div>
    <div class="row page-content">
      <div class="col-sm-12">
      <button class="btn btn-primary" onclick="toggle('manager-options')">Toggle Menu</button>
      <div id="manager-options">
        <h3>Add New Crews or Roles:</h3>
        <div class="well">
          <form class="crew-forms" method="post" action="../functions/add_crew.php">
            <div class='crew-form'>
              <input class="crew-text-box" type="text" name="crew" placeholder="Crew">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Crew</button>
            </div>
          </form>
          <form class="crew-forms" method="post" action="../functions/add_role.php">
            <div class='crew-form'>
              <input class="crew-text-box" type="text" name="role" placeholder="Role">
              <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Role</button>
            </div>
          </form>
        </div>
        <h3>Add Existing Members to Crews:</h3>

        <?php
          include '../functions/connection.php';

          $select_roles_query = $mysqli->query("SELECT * FROM ROLE");
          $select_crews_query = $mysqli->query("SELECT * FROM CREW");
          $select_members_query = $mysqli->query("SELECT * FROM MEMBER");

          echo '<div class="well"><form method="post" action="../functions/add_member_to_crew.php">';

          echo '<select style="margin-left: 10px;" name="crew_select">';
          while($crew_current_row = $select_crews_query->fetch_assoc()){

            $curr_crew = $crew_current_row['name'];
            $curr_crew_id = $crew_current_row['crew_id'];

            echo '<option value="' . $curr_crew_id .'">' . $curr_crew . '</option>';
          }

          echo '</select> ';

          echo '<select name="member_select">';
          while($member_current_row = $select_members_query->fetch_assoc()){

            $curr_first_name = $member_current_row['first_name'];
            $curr_last_name = $member_current_row['last_name'];
            $curr_mem_id = $member_current_row['mem_id'];

            echo '<option value="' . $curr_mem_id . '">' . $curr_first_name . ' ' . $curr_last_name . '</option>';
          }

          echo '</select> ';

          echo '<select name="role_select">';
          while($role_current_row = $select_roles_query->fetch_assoc()){

            $curr_role = $role_current_row['role'];
            $curr_role_id = $role_current_row['role_id'];

            echo '<option value="' . $curr_role_id . '">' . $curr_role . '</option>';
          }

          echo '</select>';
          echo ' <button type="submit" class="btn btn-success">Add to Crew</button>';
          echo '</form></div>';

          echo '<h3>Add New Member to Database:</h3>';

          echo '<div class="well"><form style="margin-left: 10px;" method="post" action="../functions/add_member.php">
                  <input type="text" name="first_name" placeholder="First Name" required>
                  <input type="text" name="middle_name" placeholder="Middle Name">
                  <input type="text" name="last_name" placeholder="Last Name" required>
                  <input type="date" name="dob" required>
                  <input type="text" name="gender" placeholder="Gender" required>
                  <input class="btn btn-success" type="submit" value="Add Member">
                </form></div>';

          $select_members_query = $mysqli->query("SELECT * FROM MEMBER");
          $select_crews_query = $mysqli->query("SELECT * FROM CREW");
          $select_movie_query = $mysqli->query("SELECT * FROM MOVIE");

          echo '<h3>Delete Member from Database:</h3>';
          echo '<div class="well"><form style="margin-left: 10px;" method="post" action="../functions/delete_member.php">';
          echo '<select name="member_select_delete">';
          while($member_current_row = $select_members_query->fetch_assoc()){

            $curr_first_name = $member_current_row['first_name'];
            $curr_last_name = $member_current_row['last_name'];
            $curr_mem_id = $member_current_row['mem_id'];

            echo '<option value="' . $curr_mem_id . '">' . $curr_first_name . ' ' . $curr_last_name . '</option>';
          }

          echo '</select> ';
          echo '<input class="btn btn-danger" type="submit" value="Delete member"></form></div>';

          echo '<h3>Associate Existing Crew with Movie:</h3>';

          echo '<div class="well"><form method="post" action="">';

          echo '<select style="margin-left: 10px;" name="crew_select_movie">';
          while($crew_current_row = $select_crews_query->fetch_assoc()){

            $curr_crew = $crew_current_row['name'];
            $curr_crew_id = $crew_current_row['crew_id'];

            echo '<option value="' . $curr_crew_id .'">' . $curr_crew . '</option>';
          }

          echo '</select> ';
          echo '<select name="movie_select">';
          while($current_movie_row = $select_movie_query->fetch_assoc()){

            $curr_movie_id = $current_movie_row['movie_id'];
            $curr_title = $current_movie_row['title'];

            echo '<option value="' . $curr_movie_id . '">' . $curr_title . '</option>';
          }
          echo '</select> ';
          echo '<input class="btn btn-success" name="add_crew_movie" type="submit" value="Add to Movie">
                <input class="btn btn-danger" name="delete_crew_movie" type="submit" value="Delete from Movie"></form></div>';

          if(isset($_POST['add_crew_movie'])){
            include '../functions/add_crew_to_movie.php';
          }
          else if(isset($_POST['delete_crew_movie'])){
            include '../functions/delete_crew_from_movie.php';
          }

          ?>
        </div>
        <?php
        if(!empty($message) && $status == 'Success'){
          echo '<br><div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
          $_SESSION['message'] = '';
        }
        else if(!empty($message) && $status == 'Failure'){
          echo '<br><div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . $message . '</div>';
          $_SESSION['message'] = '';
        }

        //makes sure no one can access this page if they are not a manager
        if($admin_tag != 1){

          $_SESSION['message'] = 'Request Failed. You do not have permission to view that page!';
          $_SESSION['status'] = 'Failure';

          header("location: main_page.php");
        }

        $crews_query = $mysqli->query("SELECT * FROM CREW");

        if($crews_query){

          while($current_row = $crews_query->fetch_assoc()){
            $crew_name = $current_row['name'];
            $crew_id = $current_row['crew_id'];

            echo '<div class="crew-result"><div class="btn-info crew-result-title">Crew</div><div class="crew-result-content"><h3>' . $crew_name . '</h3>';

            //find the members in the crew
            $has_members_query = $mysqli->query("SELECT * FROM has_members WHERE crew_id = $crew_id");

            if($has_members_query){

              while($current_has_members_row = $has_members_query->fetch_assoc()){
                $role_id = $current_has_members_row['role_id'];
                $mem_id = $current_has_members_row['mem_id'];

                //find the info on the role and member
                $member_query = $mysqli->query("SELECT * FROM MEMBER WHERE mem_id = $mem_id");
                $role_query = $mysqli->query("SELECT * FROM ROLE WHERE role_id = $role_id");

                if($member_query && $role_query){
                  $c_member = $member_query->fetch_assoc();
                  $c_role = $role_query->fetch_assoc();

                  $mem_first_name = $c_member['first_name'];
                  //$mem_middle_name = $c_member['middle_name'];
                  $mem_last_name = $c_member['last_name'];
                  //$mem_dob = $c_member['dob'];
                  //$mem_gender = $c_member['gender'];

                  $role = $c_role['role'];

                  echo '<a class="light-x" href="../functions/delete_member_from_crew.php?mem_id=' . $mem_id . '&role_id=' . $role_id . '&crew_id=' . $crew_id . ' " onclick="return confirm(\'Are you sure you want to remove the member ' . $mem_first_name . ' ' . $mem_last_name . ' from the crew ' . $crew_name . '?\')"><i class="fa fa-times" aria-hidden="true"></i></a> ';

                  echo $mem_first_name . ' ' . $mem_last_name . ' -' . $role . '<br>';
                }
              }
            }
            echo '<div class="crew-result-functions">
                    <a href="../functions/delete_crew.php?crew_id=' . $crew_id . '"><button type="button" class="btn btn-danger">Delete Crew</button></a>
                  </div></div></div>';
          }
        }
        else{
          die("Error");
        }

      ?>
    </div>
    </div>
  </body>
</html>
