<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BL Login Portal</title>

  <?php include 'links.php' ?>
  <link rel="stylesheet" href="style.css">
</head>

<body>

  <!----------------------Navbar---------------------->

  <section class="heading">

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="login.php" target=”_blank”>
        <img src="images/Banglalink_logo.png" alt="BL-Logo">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse d-flex justify-content-end" id="navbarNav">
        <ul class="navbar-nav" style="margin-right: 30px;">

          <li class="nav-item">
            <a class="nav-link" href="#login">Login</a>
          </li>

        </ul>
      </div>
    </nav>

  </section>


  <!----------------------Form Area-------------------->

  <div class="container" id="login">

    <form action="logincheck.php" method="POST" class="login-area">
      <p class="login-text">Login</p>
      <div class="input-group">
        <input type="name" class="form-control" placeholder="Username" name="user" value="" required>
      </div>
      <div class="input-group">
        <input type="password" class="form-control" placeholder="Password" name="pass" value="" required>
      </div>
      <div class="input-group">
        <button name="submit" class="btn">Login</button>
      </div>
    </form>
  </div>


  <!---------------------------Carousel----------------------->

  <section class="top-banners col-sm-auto">
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
      <div class="carousel-inner">

        <div class="carousel-item active" data-interval="5000">
          <img src="images/fastest.png" class="d-block w-100" alt="i2">
        </div>
        <div class="carousel-item" data-interval="5000">
          <img src="images/khushi.jpg" class="d-block w-100" alt="i3">
        </div>
        <div class="carousel-item" data-interval="5000">
          <img src="images/beshi_dorkar.jpg" class="d-block w-100" alt="i4">
        </div>
      </div>
      <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only"></span>
      </a>
    </div>
  </section>


  <footer>
    <h6>©2022. All rights reserved. Banglalink.</h6>
  </footer>

</body>

</html>