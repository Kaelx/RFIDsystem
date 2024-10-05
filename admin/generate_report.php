<?php

$codeNum = rand(100000000000, 999999999999);

$uid = $_GET['uid'];
$type = $_GET['type'];

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';

$query_profile = "SELECT 
  COALESCE(s.fname, e.fname, v.fname) AS fname, 
  COALESCE(s.mname, e.mname, v.mname) AS mname, 
  COALESCE(s.lname, e.lname, v.lname) AS lname,
  COALESCE(s.school_id, e.school_id, NULL) AS school_id,
  COALESCE(s.img_path, e.img_path, v.img_path) AS img_path,
  COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name,
  COALESCE(e_t.employee_type,null, null ) AS employee_type,
  COALESCE(e_l.employee_lvl,null, null ) AS employee_lvl
  FROM records r
  LEFT JOIN students s ON r.record_id = s.id AND r.record_table = 'students'
  LEFT JOIN employees e ON r.record_id = e.id AND r.record_table = 'employees'
  LEFT JOIN visitors v ON r.record_id = v.id AND r.record_table = 'visitors'
  LEFT JOIN employee_type e_t ON e.employee_type_id = e_t.id
  LEFT JOIN employee_lvl e_l ON e.employee_lvl_id = e_l.id
  LEFT JOIN role r_s ON s.role_id = r_s.id
  LEFT JOIN role r_e ON e.role_id = r_e.id
  LEFT JOIN role r_v ON v.role_id = r_v.id
  WHERE r.record_id = '$uid' and r.record_table = '$type'";

$result_profile = $conn->query($query_profile);
$profile = $result_profile->fetch_assoc();

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
      <div class="text-right">
        <button class="btn btn-primary btn-custom" onclick="window.print();"><i class="fa-solid fa-print"></i> Print</button>
        <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
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
              <img src="<?= isset($profile['img_path']) ? 'assets/img/' . $profile['img_path'] : 'assets/img/blank-img.png'; ?>" alt="Profile Picture" style="height: 125px; width: auto;">
            </div>
            <div class="col-sm-8 p-0">
              <p style="margin-bottom: 5px;"><?= isset($profile['fname']) ? $profile['fname'] : ''; ?>
                <?= isset($profile['mname']) ? strtoupper(substr($profile['mname'], 0, 1)) . '. ' : ''; ?>
                <?= isset($profile['lname']) ? $profile['lname'] : ''; ?></p>
              <p style="margin-bottom: 5px;"><?= isset($profile['school_id']) ? $profile['school_id'] : ''; ?></p>
              <p style="margin-bottom: 5px;"><?= isset($profile['role_name']) ? $profile['role_name'] : ''; ?></p>
              <?php if (!empty($profile['employee_type'])): ?>
                <p style="margin-bottom: 5px;"><?= $profile['employee_type']; ?>
                  <span>(<?= isset($profile['employee_lvl']) ? $profile['employee_lvl'] : ''; ?>)</span>
                </p>
              <?php endif; ?>
            </div>
          </div>

          <div class="col-sm-6 text-right">
            <?php date_default_timezone_set('Asia/Manila'); ?>
            <p style="margin-bottom: 5px;">Date: <?= date('F d, Y'); ?><span> <?= date('h:i A'); ?></span></p>
            <p style="margin-bottom: 5px;">Reference ID: <span> <?php echo $codeNum; ?></span></p>
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
                <th class="text-center">Duration</th>
              </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $result_records->fetch_assoc()):
                  $timein = new DateTime($row['timein']);
                  $timeout = isset($row['timeout']) ? new DateTime($row['timeout']) : null;
                ?>
                  <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td class="text-center"><?= (new DateTime($row['record_date']))->format('F d, Y'); ?></td>
                    <td class="text-center"><?= $timein->format('h:i A'); ?></td>
                    <td class="text-center"><?= $timeout ? $timeout->format('h:i A') : '------'; ?></td>
                    <td class="text-center"><?= $timeout ? $timein->diff($timeout)->format('%h hours %i minutes') : '------'; ?></td>
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

  window.addEventListener("load", window.print());
</script>