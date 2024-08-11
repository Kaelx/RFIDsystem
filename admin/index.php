<?php
session_start();

// error_reporting(0);


if (!isset($_SESSION['login_id'])) {
  header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>RFID SYSTEM</title>

  <?php
  include 'header.php';
  ?>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="../assets/defaults/evsu-logo.png" alt="evsu" width="150">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Navbar-->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
          <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=setting">Settings</a></li>
            <li><a class="dropdown-item" href="ajax.php?action=logout">Logout</a></li>
          </ul>
        </li>
      </ul>

    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link hover">
        <img src="../assets/defaults/evsu-logo.png" alt="evsu Logo" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">EVSU RFID</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item menu-open">
            <li class="nav-item">
              <a href="index.php?page=home" class="nav-link">
                <i class="fa fa-gauge nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>
            </li>
            <li class="nav-item">
              <a href="index.php?page=rfid" class="nav-link">
                <i class="fa fa-qrcode nav-icon"></i>
                <p>Scan RFID</p>
              </a>
            </li>

            <li class="nav-header">Examples</li>
            <li class="nav-item">
              <a href="index.php?page=test" class="nav-link">
                <i class="nav-icon fa fa-table"></i>
                <p>
                  Test
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=about" class="nav-link">
                <i class="nav-icon fa fa-circle-info"></i>
                <p>About</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>



    <!-- Main content -->
    <?php
    $allowed_pages = ['home', 'about', 'rfid', 'test','setting'];

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if (in_array($page, $allowed_pages)) {
      include $page . '.php';
    } else {
      header('Location: index.php?page=home');
    }
    ?>


  </div>






  </div>
</body>


<?php
include 'footer.php';
?>


</html>