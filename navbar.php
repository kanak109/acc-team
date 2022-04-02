<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  .heading {
    margin-bottom: 8rem;
  }

  .nav-item {
    font-weight: 600;
  }



  .heading img {
    margin-left: 30px;
    max-height: 5%;
    max-width: 35%;

  }
</style>

<!----------------------Navbar---------------------->
<section class="heading">

  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <div class="container-fluid">

      <a class="navbar-brand" href="index.php">

        <img src="images/Banglalink_logo.png" alt="BL-Logo">

      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="acra/display-acra.php">ACRA</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ivr/display_ivr.php">IVR-158 Userlist</a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="dialer/display_dialer.php">Dialer</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ip/display_ip.php">IP Phone Userlist</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="kurve/display_kurve.php">Kurve Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="cm/display_cm.php">CM Userlist</a>
          </li>

        </ul>

      </div>
      <div class="d-flex justify-content-end">

        <button class="btn btn-danger">
          <a href="logout.php" class="text-light">Logout</a>
        </button>
      </div>
    </div>
  </nav>

</section>