<?php


$uid = $_GET['uid'];
$type = $_GET['type'];


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




// Set default month and year to current month and year if not selected
$currentMonth = isset($_POST['month']) ? $_POST['month'] : date('m');
$currentYear = isset($_POST['year']) ? $_POST['year'] : date('Y');
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $currentMonth, $currentYear);
$monthFormatted = date('F', mktime(0, 0, 0, $currentMonth, 10));
?>




<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-6">


          <!-- Month and Year Selection Form -->
          <form method="post" action="" class="d-flex align-items-center">
            <label for="month">Month:</label>
            <select class="form-control w-25 mr-2" name="month" id="month">
              <?php
              for ($m = 1; $m <= 12; $m++) {
                $monthValue = str_pad($m, 2, '0', STR_PAD_LEFT);
                $monthName = date('F', mktime(0, 0, 0, $m, 10));
                $selected = ($monthValue == $currentMonth) ? 'selected' : '';
                echo "<option value='$monthValue' $selected>$monthName</option>";
              }
              ?>
            </select>

            <label for="year">Year:</label>
            <select class="form-control w-25 mr-2" name="year" id="year">
              <?php
              $startYear = date('Y') - 5;
              $endYear = date('Y');
              for ($y = $startYear; $y <= $endYear; $y++) {
                $selected = ($y == $currentYear) ? 'selected' : '';
                echo "<option value='$y' $selected>$y</option>";
              }
              ?>
            </select>

            <button type="submit" class="btn btn-primary">
              <i class="fa-solid fa-magnifying-glass"></i>
            </button>
          </form>



        </div>
        <div class="col-6 text-right">
          <button class="btn btn-primary btn-custom" onclick="window.print()"><i class="fa-solid fa-print"></i> Print</button>
          <a href="?p=employee_data" class="btn btn-danger btn-custom">Cancel</a>
        </div>
      </div>
    </div>
  </section>

  <section class="content">
    <div class="container-fluid">
      <div class="invoice p-5">
        <div class="row">
          <div class="col-5">
            <div>
              <div class="text-center">
                <h4 class="m-3" style="font-weight: bold;">Daily Time Record</h4>
              </div>


              <?php

              // Query to fetch records for the selected month and year
              $recordsQuery = "SELECT r.record_date, r.timein, r.timeout
                  FROM records r
                  WHERE r.record_id = '$uid' 
                  AND r.record_table = '$type'
                  AND MONTH(r.record_date) = '$currentMonth'
                  AND YEAR(r.record_date) = '$currentYear'";
              $recordsResult = $conn->query($recordsQuery);

              // Store records in an associative array by date for quick access
              $records = [];
              while ($row = $recordsResult->fetch_assoc()) {
                $date = date('Y-m-d', strtotime($row['record_date']));
                $records[$date] = [
                  'timein' => $row['timein'],
                  'timeout' => $row['timeout']
                ];
              }
              ?>

              <!-- Display Name and Selected Month/Year -->
              <div style="margin: 0; padding: 0;">
                <p style="margin: 0;">Name: <span style="font-weight: bold; text-decoration: underline;">
                    <?= $member['fname'] . (!empty($member['mname']) ? ' ' . $member['mname'] . '.' : '') . ' ' . $member['lname'] . (!empty($member['sname']) ? ' ' . $member['sname'] : ''); ?>
                  </span></p>

                <p style="margin: 0;">For the Month of <span style="font-weight: bold; text-decoration: underline;">
                    <?php echo $monthFormatted; ?></span> Year <span style="font-weight: bold; text-decoration: underline;">
                    <?php echo $currentYear; ?>
                  </span></p>
              </div>

              <!-- Display Attendance Table -->
              <div class="table-responsive">
                <table class="table text-nowrap table-hover table-bordered compact">
                  <thead>
                    <tr>
                      <th class="text-center" rowspan="2">Days</th>
                      <th class="text-center" colspan="2">A.M.</th>
                      <th class="text-center" colspan="2">P.M.</th>
                    </tr>
                    <tr>
                      <th class="text-center w-25">Arrival</th>
                      <th class="text-center w-25">Departure</th>
                      <th class="text-center w-25">Arrival</th>
                      <th class="text-center w-25">Departure</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    for ($day = 1; $day <= $daysInMonth; $day++) {
                      $dayFormatted = str_pad($day, 2, '0', STR_PAD_LEFT);
                      $dateString = "$currentYear-$currentMonth-$dayFormatted";
                      $timeIn = isset($records[$dateString]['timein']) ? date('h:i A', strtotime($records[$dateString]['timein'])) : '';
                      $timeOut = isset($records[$dateString]['timeout']) ? date('h:i A', strtotime($records[$dateString]['timeout'])) : '';

                      $amArrival = ($timeIn && strtotime($timeIn) < strtotime("12:00:00")) ? $timeIn : '';
                      $pmArrival = ($timeIn && strtotime($timeIn) >= strtotime("12:00:00")) ? $timeIn : '';
                      $amDeparture = ($timeOut && strtotime($timeOut) < strtotime("12:00:00")) ? $timeOut : '';
                      $pmDeparture = ($timeOut && strtotime($timeOut) >= strtotime("12:00:00")) ? $timeOut : '';
                      echo "<tr>
                    <td class='text-center'>$dayFormatted</td>
                    <td class='text-center'>$amArrival</td>
                    <td class='text-center'>$amDeparture</td>
                    <td class='text-center'>$pmArrival</td>
                    <td class='text-center'>$pmDeparture</td>
                </tr>";
                    }
                    ?>
                  </tbody>
                </table>
              </div>






            </div>
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
</script>