<?php

if (!isset($_GET['uid']) || empty($_GET['uid'])) {
  header('Location: index');
}

$uid = $_GET['uid'];
$type = $_GET['type'];

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';

$query = "SELECT r.record_date, r.timein, r.timeout,
COALESCE(s.fname, e.fname, v.fname) AS fname, 
COALESCE(s.mname, e.mname, v.mname) AS mname, 
COALESCE(s.lname, e.lname, v.lname) AS lname,
COALESCE(s.school_id, e.school_id, NULL) AS school_id,
COALESCE(s.img_path, e.img_path, v.img_path) AS img_path,
COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name
FROM records r
LEFT JOIN students s ON r.record_id = s.id AND r.record_table = 'students'
LEFT JOIN employees e ON r.record_id = e.id AND r.record_table = 'employees'
LEFT JOIN visitors v ON r.record_id = v.id AND r.record_table = 'visitors'
LEFT JOIN role r_s ON s.role_id = r_s.id
LEFT JOIN role r_e ON e.role_id = r_e.id
LEFT JOIN role r_v ON v.role_id = r_v.id
WHERE r.record_id = '$uid' and r.record_table = '$type'";

if (!empty($start_date) && !empty($end_date)) {
  $query .= " AND DATE(r.timein) BETWEEN '$start_date' AND '$end_date'
    AND DATE(r.timeout) BETWEEN '$start_date' AND '$end_date'";
}

$result = $conn->query($query);
$wew = $result->fetch_assoc(); // Fetching the profile picture once to use below
?>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Report</h1>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="invoice p-3">
        <div class="row">
          <div class="col-12">
            <h2 class="page-header" style="font-family: 'Times New Roman', Times, serif; font-size: 20px; display: flex; justify-content: center;">
              <img src="assets/defaults/evsu.png" alt="evsu-logo" style="height: 100px; width: auto; margin-right: 10px;">
              <div style="text-align: center; margin-right: 80px;">
                <p style="margin: 0;">Republic of the Philippines</p>
                <p style="color: #a91414; margin: 0;">EASTERN VISAYAS STATE UNIVERSITY</p>
                <p style="color: #a91414; margin: 0;">ORMOC CAMPUS</p>
                <p style="margin: 0;">Ormoc City 06541</p>
              </div>
            </h2>
          </div>
        </div>

        <div class="row invoice-info">
          <div class="col-sm-6 invoice-col">
            <p>Information Logs of:</p>
            <p><?= $wew['fname'] . ' ' . $wew['mname'] . ' ' . $wew['lname']; ?></p>
            <p><?= $wew['role_name']; ?></p>
          </div>

          <div class="col-sm-6 invoice-col text-right">
            <p>Profile Picture</p>
            <img src="<?= 'assets/img/' . $wew['img_path']; ?>" alt="Profile Picture" style="height: 100px; width: auto;">
          </div>
        </div>

        <div class="table-responsive">
          <table class="table table-hover table-bordered compact">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Date</th>
                <th class="text-center">Time in</th>
                <th class="text-center">Time out</th>
                <th class="text-center">Duration</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              // Reset result pointer to fetch data for table
              $result->data_seek(0);
              while ($row = $result->fetch_assoc()): ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td>
                    <?php
                    $timein = new DateTime($row['record_date']);
                    echo $timein->format('F d, Y');
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    $timein = new DateTime($row['timein']);
                    echo $timein->format('h:i A');
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    if (!empty($row['timeout'])) {
                      $timeout = new DateTime($row['timeout']);
                      echo $timeout->format('h:i A');
                    } else {
                      echo '------';
                    }
                    ?>
                  </td>
                  <td class="text-center">
                    <?php
                    if (!empty($row['timeout'])) {
                      $interval = $timein->diff($timeout);
                      echo $interval->format('%h hours %i minutes');
                    } else {
                      echo '------';
                    }
                    ?>
                  </td>
                </tr>
              <?php endwhile; ?>
            </tbody>
          </table>
        </div>

        <div class="row invoice-info">
          <?php
          date_default_timezone_set('Asia/Manila'); // Set the timezone to GMT+08
          ?>

          <div class="col-sm-4 invoice-col">
            <p>Generated Date:</p>
            <p><?= date('F d, Y'); ?></p>
            <p><?= date('h:i A'); ?></p>
          </div>

          <div class="col-sm-4 invoice-col">
            <p>Generate ID#:</p>
            <p><!-- Unique Number here --></p>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<script>
  $('table').DataTable({
    ordering: false,
    stateSave: true,
    lengthChange: false,
    searching: false,
    info: false,
    paging: false
  });

  window.addEventListener("load", window.print());
</script>