<?php


$report_id = $_GET['report_id'];
$uid = $_GET['uid'];
$type = $_GET['type'];

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';

switch ($type) {
  case 'student':
    $query = "SELECT s.id, s.fname, s.mname, s.lname, s.school_id, r.role_name, s.rfid, s.img_path, s.gender
FROM students s
LEFT JOIN role r ON s.role_id = r.id
WHERE s.id = '$uid'
";
    break;

  case 'employee':
    $query = "SELECT e.id, e.fname, e.mname, e.lname, e.school_id, et.employee_type, r.role_name, e.rfid, e.img_path, e.gender
FROM employees e
LEFT JOIN role r ON e.role_id = r.id
LEFT JOIN employee_type et ON e.employee_type_id = et.id
WHERE e.id = '$uid'
";
    break;

  case 'visitor':
    $query = "SELECT v.id, v.fname, v.mname, v.lname, NULL as school_id, r.role_name, v.rfid, v.img_path, v.gender
FROM visitors v
LEFT JOIN role r ON v.role_id = r.id
WHERE v.id = '$uid'
";
    break;

  default:
    die('Invalid type');
}

$result = $conn->query($query);
$member = $result->fetch_assoc();



$query_records = "SELECT r.record_date, r.timein, r.timeout
  FROM records r
  WHERE r.record_id = '$uid' AND r.record_table = '$type'";

if (!empty($start_date) && !empty($end_date)) {
  $query_records .= " AND DATE(r.record_date) BETWEEN '$start_date' AND '$end_date'";
}

$result_records = $conn->query($query_records);
?>
<style>
  .content {
    margin-left: 80px;
    margin-right: 80px;
  }
</style>

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Data Report</h1>
        </div>
      </div>
      <div class="row">
        <button class="btn btn-primary btn-custom m-2" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-secondary btn-custom m-2" onclick="window.history.back(); return false;">Back</button>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="invoice" style="padding: 100px;">
        <div class="row">
          <div class="col-12">
            <h2 class="page-header" style="font-family: 'Times New Roman', Times, serif; font-size: 20px; display: flex; justify-content: center;">
              <img src="assets/defaults/evsu.png" alt="evsu-logo" style="height: 100px; width: auto; margin-right: 10px;">
              <div style="text-align: center; margin-right: 100px;">
                <p style="margin: 0;">Republic of the Philippines</p>
                <p style="color: #a91414; margin: 0;">EASTERN VISAYAS STATE UNIVERSITY</p>
                <p style="color: #a91414; margin: 0;">ORMOC CAMPUS</p>
                <p style="margin: 0;">Ormoc City 06541</p>
              </div>
            </h2>
          </div>
        </div>

        <div class="text-center">
          <h3 class="m-3" style="font-family: 'Times New Roman', Times, serif;">Record Report</h3>
        </div>

        <div class="row invoice-info">
          <div class="col-sm-6 d-flex align-items-start">
            <div class="col-sm-4 p-0">
              <img src="<?= isset($member['img_path']) ? 'assets/img/' . $member['img_path'] : 'assets/img/blank-img.png'; ?>" alt="Profile Picture" style="height: 125px; width: auto;">
            </div>
            <div class="col-sm-8 p-0">
              <p style="margin-bottom: 5px;"><?= isset($member['fname']) ? $member['fname'] : ''; ?>
                <?= isset($member['mname']) ? strtoupper(substr($member['mname'], 0, 1)) . '. ' : ''; ?>
                <?= isset($member['lname']) ? $member['lname'] : ''; ?></p>
              <p style="margin-bottom: 5px;"><?= isset($member['school_id']) ? $member['school_id'] : ''; ?></p>
              <p style="margin-bottom: 5px;"><?= isset($member['role_name']) ? $member['role_name'] : ''; ?></p>
              <?php if (!empty($member['employee_type'])): ?>
                <p style="margin-bottom: 5px;"><?= $member['employee_type']; ?></p>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-sm-6 text-right">
            <?php date_default_timezone_set('Asia/Manila'); ?>
            <p style="margin-bottom: 5px;">Date: <?= date('F d, Y'); ?><span> <?= date('h:i A'); ?></span></p>
            <p style="margin-bottom: 5px;">Reference ID: <span> <?php echo $report_id; ?></span></p>
          </div>
        </div>



        <div class="table-responsive">

          <!-- Display Date Range -->
          <?php if (!empty($start_date) && !empty($end_date)): ?>
            <div class="text-center mt-2 text-bold">
              <p>From <?= (new DateTime($start_date))->format('F j, Y'); ?> to <?= (new DateTime($end_date))->format('F j, Y'); ?></p>
            </div>
          <?php endif; ?>

          <table class="table table-hover table-bordered compact">
            <thead>
              <tr>
                <th class="text-center">#</th>
                <th class="text-center">Date</th>
                <th class="text-center">Time in</th>
                <th class="text-center">Time out</th>
                <!-- <th class="text-center">Duration</th> -->
              </tr>
            </thead>
            <tbody>
              <?php
              $i = 1;
              while ($row = $result_records->fetch_assoc()):
                // Initialize DateTime objects or set to null
                $timein = (!empty($row['timein']) && $row['timein'] != '00:00:00') ? new DateTime($row['timein']) : null;
                $timeout = (!empty($row['timeout']) && $row['timeout'] != '00:00:00') ? new DateTime($row['timeout']) : null;

                // Calculate the duration only if both timein and timeout are set
                // $duration = ($timein && $timeout) ? $timein->diff($timeout)->format('%h hours %i minutes') : '------';
              ?>
                <tr>
                  <td class="text-center"><?= $i++; ?></td>
                  <td class="text-center"><?= (new DateTime($row['record_date']))->format('F d, Y'); ?></td>
                  <td class="text-center"><?= $timein ? $timein->format('h:i A') : '------'; ?></td>
                  <td class="text-center"><?= $timeout ? $timeout->format('h:i A') : '------'; ?></td>
                  <!-- <td class="text-center"><?= $duration; ?></td> -->
                </tr>
              <?php endwhile; ?>
            </tbody>

          </table>
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


  window.addEventListener('beforeunload', function(e) {
    const confirmationMessage = 'Are you sure you want to leave this page? Your changes may not be saved.';

    e.returnValue = confirmationMessage;
    return confirmationMessage;
  });


  window.addEventListener('load', function() {
    window.print();
  });
</script>