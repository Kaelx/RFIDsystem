<?php
session_start();
ob_start();

// error_reporting(E_ALL);

include 'db_connect.php';


if (!isset($_SESSION['login_id'])) {
  header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ELEVATECH RFID</title>

  <link rel="icon" type="image/png" href="assets/defaults/logo-img.png">

  <?php
  include 'header.php';
  ?>

</head>

<body class="hold-transition layout-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <!-- <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__shake" src="assets/defaults/evsu-logo.png" alt="evsu" width="150">
    </div> -->

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Navbar-->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user fa-fw mr-1"></i><?php echo $_SESSION['login_fname']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item " href="index.php?page=setting">Settings</a></li>
            <li><a class="dropdown-item " href="ajax.php?action=logout">Logout</a></li>
          </ul>
        </li>

      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link hover">
        <img src="assets/defaults/logo-img2.png" alt="icon" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">Elevatech RFID</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-header">Main</li>

            <li class="nav-item">
              <a href="index.php?page=home" class="nav-link">
                <i class="fa-solid fa-gauge nav-icon"></i>
                <p>Dashboard</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=data" class="nav-link">
                <i class="fa-solid fa-id-card nav-icon"></i>
                <p>Register</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=rfid" class="nav-link">
                <i class="fa-solid fa-qrcode nav-icon"></i>
                <p>Scan RFID</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="index.php?page=entrylogs" class="nav-link">
              <i class="fa-solid fa-clipboard-user nav-icon"></i>
                <p>Records</p>
              </a>
            </li>

            <li class="nav-header">Others</li>

            <li class="nav-item">
              <a href="index.php?page=category" class="nav-link">
                <i class="fa-solid fa-bars-progress nav-icon"></i>
                <p>
                  Manage Category
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=accountmanage" class="nav-link">
                <i class="fa-solid fa-users nav-icon"></i>
                <p>
                  Manage Account
                </p>
              </a>
            </li>

          </ul>
        </nav>
      </div>
    </aside>

    <!-- Toast Alert -->
    <div class="position-fixed" style="top:50px; right: 0; padding: 1rem; z-index: 1050;">
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white" style="font-size:18px;">
        </div>
      </div>
    </div>




    <!-- content -->
    <?php
    $allowed_pages = ['home', 'rfid', 'category', 'setting', 'register', 'data', 'accountmanage', 'view', 'entrylogs'];

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if (in_array($page, $allowed_pages)) {
      include $page . '.php';
    } else {
      header('Location: index.php?page=home');
    }
    ?>



    <!-- modal -->
    <div class="modal fade" id="confirm_modal" role='dialog'>
      <div class="modal-dialog modal-md modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Confirmation</h5>
          </div>
          <div class="modal-body">
            <div id="delete_content"></div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-primary" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->



  </div>






  </div>
</body>

<script>
  var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  if (page) {
    $('ul.nav-sidebar a').each(function() {
      var href = $(this).attr('href');
      if (href && href.indexOf('page=' + page) !== -1) {
        $(this).addClass('active');
      }
    });
  }
</script>


<?php
include 'footer.php';

// ob_end_flush();
?>


</html>