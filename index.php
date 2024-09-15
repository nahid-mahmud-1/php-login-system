<?php

  require_once "includes/config_session.inc.php";
  require_once "includes/signup_view.inc.php";
  require_once "includes/login_view.inc.php";

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & SignUp System</title>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Reset CSS -->
    <link rel="stylesheet" href="assets/css/reset.css">
    <!-- Theme Main CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
  </head>
  <body>

    <!-- Login Form -->

    <?php

      if(!isset($_SESSION["user_id"])){?>

      <h3>Login</h3>
      <form action="includes/login.inc.php" method="POST">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="pwd" placeholder="Password">
        <button type="submit">Login</button>
      </form>

      <!-- SignUp Form -->
      <h3>SignUp</h3>
      <form action="includes/signup.inc.php" method="POST">
      <?php
      signup_inputs();
      ?>
      <button type="submit">SignUp</button>
    </form>

    <?php }else{

      output_username();
    ?>

    <!-- LogOut -->
    <form action="includes/logout.inc.php" method="POST">
      <button style="width: 30%; margin: 20px auto; display:block;">Logout</button>
    </form>

    <?php

    }

    check_login_errors();
    check_signup_errors();


    ?>

  </body>
</html>