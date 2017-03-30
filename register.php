<html>
  <head>
    <title>Registration Form</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <?php
      if(!empty($_POST)){
        
      }
    ?>
  </head>
  <body>
    <div class="register-container">
      <form method="post" action="">
        <input type="text" name="first-name" placeholder="First Name" required><br>
        <input type="text" name="middle-name" placeholder="Middle Name"><br>
        <input type="text" name="last-name" placeholder="Last Name" required><br>
        <input type="date" name="dob"><br>
        <input type="radio" name="gender" value="Male"> Male<br>
        <input type="radio" name="gender" value="Female"> Female
      </form>
    </div>
  </body>
</html>
