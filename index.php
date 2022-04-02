<?php
session_start();

if (!isset($_SESSION['user'])) {
  header('location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Welcome</title>

  <?php include 'links.php' ?>
  <style>
    .welcome_msg {
      text-align: center;
      margin-bottom: 20px;
      display: block;
    }

    .top_body {
      background: rgb(252, 159, 78);
      background: radial-gradient(circle, rgba(252, 159, 78, 1) 35%, rgba(248, 128, 23, 1) 80%);
      height: 400px;
      padding: 80px 40px;
    }
  </style>


</head>

<body>

  <?php include 'navbar.php' ?>
  <div class="welcome_msg top_body">
    
    <h1 style="font-size: 50px; font-weight: 500;">
      Welcome</h1>
    <h3>Apps Contact Center Team!</h3>

  </div>


</body>

</html>