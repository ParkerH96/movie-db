<html>
  <head>
    <title>Registration Form</title>
    <meta charset="UTF-8">

    <!-- fix for viewport scaling -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- include bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- include stylesheets -->
    <link rel="stylesheet" href="css/main.css" type="text/css">
    <link rel="stylesheet" href="css/register_style.css" type="text/css">

    <script type="text/javascript">
      function Success(){
        alert("Registration successfull! New user added...");
      }

      function Failure(){
        alert("Registration failed! Try again...");
      }
    </script>

    <?php
      if(!empty($_POST)){
        include 'connection.php';

        //escape the strings
        $firstname = $mysqli->escape_string($_POST['first-name']);
        $middlename = $mysqli->escape_string($_POST['middle-name']);
        $lastname = $mysqli->escape_string($_POST['last-name']);
        $dob = $mysqli->escape_string($_POST['dob']);
        $gender = $mysqli->escape_string($_POST['gender']);
        $username = $mysqli->escape_string($_POST['username']);
        $password = $mysqli->escape_string($_POST['password']);

        //Create the sql query
        $sql = "INSERT INTO USER(admin_tag, first_name, middle_name, last_name, dob, gender, username, password)
        VALUES (0, '$firstname', '$middlename', '$lastname', '$dob', '$gender', '$username', '$password');";
        $result = $mysqli->query($sql);

        if($result){
          header("location: login.php");
        }
        else {
          echo "<script type='text/javascript'> Failure(); </script>";
        }

        //Close the connection
        $mysqli->close();
      }
    ?>
  </head>
  <body>
    <div class="full-bg-img background-img">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-6 col-sm-offset-3 register-container">
            <img src="https://www.hit4hit.org/img/login/user-icon-6.png"></img>
            <h2>Movie-DB Register:</h2>
            <form method="post" action="">
              <div class="form-input">
                <input type="text" name="first-name" placeholder="First Name" required><br>
                <input type="text" name="middle-name" placeholder="Middle Name"><br>
                <input type="text" name="last-name" placeholder="Last Name" required><br>
                <input type="date" name="dob"><br>
                <input type="text" name="gender" placeholder="Gender" required><br>
                <input type="text" name="username" placeholder="Username" required><br>
                <input type="password" name="password" placeholder="Password" required><br>
              </div>
              <input type="submit" name="submit" value="Register" class="register-btn">
            </form>
            <a href="login.php">Already a User? Login here.</a>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
