<html>
  <head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">

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
    <div class="register-container">
      <h1><span style="color: coral; font-weight: bold;">Sign Up!</span></h1>
      <form method="post" action="">
        <input type="text" name="first-name" placeholder="First Name" required><br>
        <input type="text" name="middle-name" placeholder="Middle Name"><br>
        <input type="text" name="last-name" placeholder="Last Name" required><br>
        <input type="date" name="dob"><br>
        <input type="text" name="gender" placeholder="Gender" required><br>
        <input type="text" name="username" placeholder="Username" required><br>
        <input type="password" name="password" placeholder="Password" required><br>
        <input type="submit" name="submit" value="Register" class="login-btn">
      </form>
    </div>
  </body>
</html>
