<!DOCTYPE html>
<html>
  <head>
    <title>Login Form</title>
    <meta charset="UTF-8">

    <!-- Javascipt -->
    <script type="text/javascript">
      function Success(){
        alert("Login was succesfull!");
      }
      function PassFailure(){
        alert("Login unsuccesfull. The password was not correct.");
      }
      function UserFailure(){
        alert("Login unseccesfull. The username could not be found.");
      }
    </script>

    <link rel="stylesheet" href="css/main.css" type="text/css">

    <?php
      if(!empty($_POST)){

        include 'connection.php';

        //escape the strings
        $username = $mysqli->escape_string($_POST['username']);
        $password = $mysqli->escape_string($_POST['password']);

        //Gather the query for finding the particular username
        $sql = "SELECT password FROM LOGIN WHERE username='$username'";
        $result = $mysqli->query($sql);

        if($result->num_rows == 0){
          echo "<script type='text/javascript'> UserFailure(); </script>";
        }
        else{
          $row = $result->fetch_assoc();

          if($password === $row['password']){
            echo "<script type='text/javascript'> Success(); </script>";
          }
          else{
            echo "<script type='text/javascript'> PassFailure(); </script>";
          }
        }

        //Close the connection
        $mysqli->close();
      }

    ?>
  </head>
  <body>
    <div class="login-container">
      <img src="https://www.hit4hit.org/img/login/user-icon-6.png"></img>
      <form method="post" action="">
        <div class="form-input">
          <input type="text" name="username" required><br>
          <input type="password" name="password" required>
        </div>
        <input type="submit" name="submit" value="LOGIN" class="login-btn">
      </form>
      <br><br>
      <a href="#">forgot password?</a>
    </div>
  </body>
</html>
