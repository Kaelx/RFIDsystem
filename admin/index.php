<?php
session_start();
error_reporting(0);
ob_start();

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
  <title>EVSU RFID</title>

  <link rel="icon" type="image/png" href="assets/defaults/rfid.png">

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
          <a class="nav-link text-white" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">

        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle d-flex align-items-center text-white" id="navbarDropdown" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-user fa-fw mr-1"></i><?php echo $_SESSION['login_fname']; ?>
          </a>
          <ul class="dropdown-menu dropdown-menu-right " aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="index.php?page=account_setting"><i class="fa-solid fa-user-gear"></i> Profile settings</a></li>
            <li><a class="dropdown-item" href="ajax.php?action=logout"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
          </ul>
        </li>

      </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="" class="brand-link hover">
        <img src="assets/defaults/rfid.png" alt="icon" class="brand-image img-circle elevation-3">
        <span class="brand-text font-weight-light">RFID SYSTEM</span>
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

            <?php
            if ($_SESSION['login_account_type'] == 0 || $_SESSION['login_account_type'] == 1 || $_SESSION['login_account_type'] == 2): ?>
              <li class="nav-item">
                <a href="index.php?page=employee_data" class="nav-link">
                  <i class="fa-solid fa-user-tie nav-icon"></i>
                  <p>Employees</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=student_data" class="nav-link">
                  <i class="fa-solid fa-graduation-cap nav-icon"></i>
                  <p>Students</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=vendor_data" class="nav-link">
                  <i class="fa-solid fa-store nav-icon"></i>
                  <p>Vendors</p>
                </a>
              </li>

            <?php endif; ?>

            <li class="nav-item">
              <a href="index.php?page=visitor_data" class="nav-link">
                <i class="fa-solid fa-people-group nav-icon"></i>
                <p>Visitors</p>
              </a>
            </li>

            <li class="nav-header">RFID</li>

            <?php if ($_SESSION['login_account_type'] == 0 || $_SESSION['login_account_type'] == 3): ?>
              <li class="nav-item d-none d-xl-block">
                <a href="index.php?page=rfid_in" class="nav-link">
                  <i class="fa-solid fa-qrcode nav-icon"></i>
                  <p>SCAN ENTRY</p>
                </a>
              </li>
              <li class="nav-item d-none d-xl-block">
                <a href="index.php?page=rfid_out" class="nav-link">
                  <i class="fa-solid fa-qrcode nav-icon"></i>
                  <p>SCAN EXIT</p>
                </a>
              </li>
            <?php endif; ?>

            <li class="nav-item">
              <a href="index.php?page=entrylogs" class="nav-link">
                <i class="fa-solid fa-clipboard-user nav-icon"></i>
                <p>Records</p>
              </a>
            </li>

            <?php
            if ($_SESSION['login_account_type'] == 0 || $_SESSION['login_account_type'] == 1 || $_SESSION['login_account_type'] == 2):
            ?>

              <li class="nav-header">Others</li>


              <li class="nav-item">
                <a href="index.php?page=archive_data" class="nav-link">
                  <i class="fa-solid fa-box-archive nav-icon"></i>
                  <p>
                    Archived Data
                    <i class="fa" id="archived-icon"></i>
                  </p>
                </a>
              </li>


              <li class="nav-item">
                <a href="index.php?page=category" class="nav-link">
                  <i class="fa-solid fa-bars-progress nav-icon"></i>
                  <p>
                    Manage Category
                  </p>
                </a>
              </li>


            <?php endif; ?>

            <?php
            if ($_SESSION['login_account_type'] == 0 || $_SESSION['login_account_type'] == 1) {
            ?>

              <li class="nav-item">
                <a href="index.php?page=accountmanage" class="nav-link">
                  <i class="fa-solid fa-user-gear nav-icon"></i>
                  <p>
                    Manage Account
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="index.php?page=system_log" class="nav-link">
                  <i class="fa-solid fa-font-awesome nav-icon"></i>
                  <p>
                    Audit Log
                  </p>
                </a>
              </li>
            <?php }; ?>

          </ul>
        </nav>
      </div>
    </aside>
    <!-- end Sidebar -->



    <!-- Toast Alert -->
    <div class="position-fixed" style="right: 1px; padding: 1rem; z-index: 99999999;">
      <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-body text-white" style="font-size:18px;">
        </div>
      </div>
    </div>
    <!-- end Toast Alert -->


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
            <button type="button" class="btn btn-danger btn-custom" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
    <!-- end modal -->



    <!-- content -->
    <?php
    $exclude = ['index'];

    $restricted_1 = ['rfid_in', 'rfid_out']; // Pages restricted for admin
    $restricted_2 = ['rfid_in', 'rfid_out', 'system_log']; // Pages restricted for specific staff
    $restricted_3 = ['employee_data', 'employee_register', 'employee_view', 'student_data', 'student_register', 'student_view', 'vendor_data', 'vendor_register', 'vendor_view', 'archive_data', 'archived_employees', 'archived_students', 'archived_vendors', 'archived_visitors', 'category', 'accountmanage', 'accountadduser', 'accountmanage_archive', 'system_log']; // Pages restricted for security personnel

    $page = isset($_GET['page']) ? basename($_GET['page']) : 'home';

    if ($_SESSION['login_account_type'] == 3 && in_array($page, $restricted_3)) {
      $page = 'home';

      header('Location: index.php?page=' . $page);
      exit;
    } elseif ($_SESSION['login_account_type'] == 2 && in_array($page, $restricted_2)) {
      $page = 'home';

      header('Location: index.php?page=' . $page);
      exit;
    } elseif ($_SESSION['login_account_type'] == 1 && in_array($page, $restricted_1)) {
      $page = 'home';

      header('Location: index.php?page=' . $page);
      exit;
    }

    if (in_array($page, $exclude) || !file_exists($page . '.php')) {
      $page = 'home';

      header('Location: index.php?page=' . $page);
      exit;
    }

    include $page . '.php';
    ?>
    <!-- end content -->





  </div>



  </div>
</body>

<script>
  var activePage = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home'; ?>';

  $('ul.nav-sidebar a').each(function() {
    var href = $(this).attr('href');

    if (href && href.indexOf('page=' + activePage) !== -1) {
      $(this).addClass('active');
    }
  });
</script>




<?php
include 'footer.php';

?>


</html>