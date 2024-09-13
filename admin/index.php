<?php
session_start();
ob_start();

error_reporting(E_ALL);

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

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light fixed-top">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
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
              <a href="index.php?page=student_data" class="nav-link">
                <i class="fa-solid fa-id-card nav-icon"></i>
                <p>Students</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=employee_data" class="nav-link">
                <i class="fa-solid fa-building-user nav-icon"></i>
                <p>Employee</p>
              </a>
            </li>

            <li class="nav-item">
              <a href="index.php?page=visitor_data" class="nav-link">
                <i class="fa-solid fa-people-group nav-icon"></i>
                <p>Visitor</p>
              </a>
            </li>

            <li class="nav-header">Attendance</li>

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
                <i class="fa-solid fa-user-gear nav-icon"></i>
                <p>
                  Manage Account
                </p>
              </a>
            </li>

          </ul>
        </nav>
      </div>
    </aside>
    <!-- end Sidebar -->



    <!-- Toast Alert -->
    <div class="position-fixed" style="top:50px; right: 0; padding: 1rem; z-index: 1050;">
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white" style="font-size:18px;">
        </div>
      </div>
    </div>
    <!-- end Toast Alert -->



    <!-- content -->
    <?php
    $allowed_pages = ['home', 'rfid', 'category', 'setting', 'student_data', 'student_register', 'student_view', 'student_edit', 'employee_data', 'employee_register', 'employee_view','employee_edit', 'visitor_data', 'visitor_register', 'visitor_view', 'entrylogs', 'accountmanage', 'adduser', 'accountedit', 'import', 'records'];

    $page = isset($_GET['page']) ? $_GET['page'] : 'home';

    if (in_array($page, $allowed_pages)) {
      include $page . '.php';
    } else {
      header('Location: index.php?page=home');
    }
    ?>
    <!-- end content -->



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
            <button type="button" class="btn btn-primary btn-custom" id='confirm' onclick="">Continue</button>
            <button type="button" class="btn btn-secondary btn-custom" data-dismiss="modal">Cancel</button>
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

ob_end_flush();
?>


</html>