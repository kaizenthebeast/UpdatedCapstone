<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../home/styles.css">

  <!-- Bootstrap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">



  <!-- Fav-icon -->
  <link rel="icon" type="image/png" sizes="32x32" href="../images/favicon_io/favicon-32x32.png">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@600&family=Moo+Lah+Lah&family=Open+Sans:wght@600&family=Roboto:wght@300&display=swap" rel="stylesheet">

  <?php
  if (isset($page_title)) {
    echo "$page_title";
  }
  ?>
</head>

<body>
  <!-- Sign In -->

  <div class="container-fluid d-flex text-end p-1 align-items-center justify-content-end text-white " style="background-color:rgb(4, 4, 132) ;">
    <?php if (!isset($_SESSION['authenticated'])) : ?>
      <a href="register.php" class="nav-link text-white me-lg-4 "><span class="sign-in">Sign in</span> </a>
    <?php endif ?>
    <?php if (isset($_SESSION['authenticated'])) : ?>
      <a href="#" class='text-decoration-none text-white'>Welcome: <span class="text-uppercase" style="color:#F9B900 ;"><?= $_SESSION['auth_user']['fullName']; ?></span>
      </a>
      <a href="../loginHome/logout.php" class="nav-link text-white me-lg-4 "><span class="sign-in">Logout</span> </a>
    <?php endif ?>
  </div>
  

  <!-- NAVBAR -->

  <div class="navbar navbar-expand-lg navbar-dark" style="background-color:white;" id="navbar">
    <div class="container-fluid ms-lg-3 me-lg-3">
      <div class="d-flex">
        <img class="img img-fluid" src="../Images/NTCLogo_n-removebg-preview.png" alt="">
        <a href="../home/index.php" class="navbar-brand fw-bolder ms-lg-2 title-logo">ACADEMIC <br> <span class="pointed">..</span> RESEARCH <br>
          <span class="pointed">.....</span> ARCHIVE</a>
      </div>

      <button class="navbar-toggler navbar-toggler-right" type="button" data-bs-toggle="collapse" data-bs-target="#navmenu">

        <span><i class="bi bi-list toggle"></i></span>

      </button>

      <div class=" collapse navbar-collapse" id="navmenu">
        <ul class="navbar-nav ms-auto navbar">
          <li class="nav-item ">

            <?php if (!isset($_SESSION['authenticated'])) : ?>
              <a href="../home/index.php" class="nav-link text-dark nav-list">HOME</a>
            <?php endif ?>
            <?php if (isset($_SESSION['authenticated'])) : ?>
              <a href="../loginHome/test.php" class="nav-link text-dark nav-list">HOME</a>
            <?php endif ?>
            
          </li>
          <li class="nav-item ">
            <?php if (isset($_SESSION['authenticated'])) : ?>
              <a href="../home/dashboard.php" class="nav-link text-dark nav-list">DASHBOARD</a>
            <?php endif ?>
            
          </li>

          <li class="nav-item">
            <a href="../userSubmitArchive/submit_archive.php" class="nav-link text-dark nav-list ">DIGITAL ARCHIVAL </a>
          </li>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-dark" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              RESEARCH CONFERENCE
            </a>
            <ul class="dropdown-menu" style="background-color:rgb(4, 4, 132) ;">
              <style>
                .dropdown-item:hover {
                  background-color: #F9B900;
                }
              </style>
              <?php if (!isset($_SESSION['authenticated'])) : ?>
                <li><a class="dropdown-item text-white" href="../home/events.php">Events</a></li>
              <?php endif ?>
              <?php if (isset($_SESSION['authenticated'])) : ?>
                <li><a class="dropdown-item text-white" href="../loginHome/loginHomeEvents.php">Events</a></li>
              <?php endif ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <?php if (!isset($_SESSION['authenticated'])) : ?>
                <li><a class="dropdown-item text-white" href="../home/guidelines.php">Guidelines</a></li>
              <?php endif ?>
              <?php if (isset($_SESSION['authenticated'])) : ?>
                <li><a class="dropdown-item text-white" href="../loginHome/loginHomeGuidelines.php">Guidelines</a></li>
              <?php endif ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-white" href="../home/reservation.php">Reservation</a></li>
            </ul>
          </li>

        </ul>
      </div>
    </div>
  </div>



  
  </section>