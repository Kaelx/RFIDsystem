<?php
if (!isset($_GET['employee_type']) || empty($_GET['employee_type'])) {
  exit();
}

$codeNum = rand(100000000000, 999999999999);
$type = $_GET['employee_type'];
$date = date('Y-m-d');

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
        <button class="btn btn-danger btn-custom" onclick="window.history.back(); return false;">Cancel</button>
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
              <div style="text-align: center; margin-right: 100px;">
                <p style="margin: 0;">Republic of the Philippines</p>
                <p style="color: #a91414; margin: 0;">EASTERN VISAYAS STATE UNIVERSITY</p>
                <p style="color: #a91414; margin: 0;">ORMOC CAMPUS</p>
                <p style="margin: 0;">Ormoc City 06541</p>
              </div>
            </h2>
          </div>
        </div>

        <div class="row invoice-info mt-2">
          <div class="col-sm-6 d-flex align-items-start">
          </div>

          <div class="col-sm-6 text-right">
            <?php date_default_timezone_set('Asia/Manila'); ?>
            <p style="margin-bottom: 5px;">Date: <?= date('F d, Y'); ?><span> <?= date('h:i A'); ?></span></p>
            <p style="margin-bottom: 5px;">Reference ID: <span> <?php echo $codeNum; ?></span></p>
          </div>
        </div>



        <div>
          <p class="text-center text-bold">LIST OF DESIGNATED FACULTY</p>
        </div>

        <?php
        $deptQuery = "SELECT * FROM department;";
        $deptResult = $conn->query($deptQuery);
        ?>

        <div class="table-responsive">
          <?php while ($deptRow = $deptResult->fetch_assoc()):
            $deptName = $deptRow['dept_name'];
            $deptId = $deptRow['id'];
          ?>

            <table class="table table-bordered compact">
              <thead>
                <tr>
                  <th class="text-center" rowspan="2">#</th>
                  <th class="text-center w-50" rowspan="2">Name of Faculty</th>
                  <th class="text-center" colspan="2">AM</th>
                  <th class="text-center" colspan="2">PM</th>
                </tr>
                <tr>
                  <th class="text-center">Time IN</th>
                  <th class="text-center">Time OUT</th>
                  <th class="text-center">Time IN</th>
                  <th class="text-center">Time OUT</th>
                </tr>
                <tr>
                  <th colspan="6"><?php echo $deptName; ?></th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;

                $query = "SELECT e.*, et.employee_type, r.record_date, r.timein, r.timeout 
                  FROM employees e
                  LEFT JOIN employee_type et ON e.employee_type_id = et.id
                  LEFT JOIN records r ON e.id = r.record_id
                  WHERE r.record_table = 'employee'
                  AND e.employee_type_id = $type
                  AND e.employee_dept_id = $deptId";

                if (!empty($date)) {
                  $query .= " AND DATE(r.record_date) BETWEEN '$date' AND '$date'";
                }

                $result = $conn->query($query);
                while ($row = $result->fetch_assoc()):
                  $amTimeIn = $amTimeOut = $pmTimeIn = $pmTimeOut = ' ---- ';

                  // Process Time IN
                  if (!empty($row['timein'])) {
                    $timeIn = DateTime::createFromFormat('H:i:s', $row['timein']);
                    if ($timeIn) {
                      if ($timeIn->format('A') === 'AM') {
                        $amTimeIn = $timeIn->format('h:i A');
                      } else {
                        $pmTimeIn = $timeIn->format('h:i A');
                      }
                    }
                  }

                  // Process Time OUT
                  if (!empty($row['timeout'])) {
                    $timeOut = DateTime::createFromFormat('H:i:s', $row['timeout']);
                    if ($timeOut) {
                      if ($timeOut->format('A') === 'AM') {
                        $amTimeOut = $timeOut->format('h:i A');
                      } else {
                        $pmTimeOut = $timeOut->format('h:i A');
                      }
                    }
                  }
                ?>
                  <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                    <td class="text-center"><?= $amTimeIn; ?></td>
                    <td class="text-center"><?= $amTimeOut; ?></td>
                    <td class="text-center"><?= $pmTimeIn; ?></td>
                    <td class="text-center"><?= $pmTimeOut; ?></td>
                  </tr>

                <?php endwhile; ?>
              </tbody>
            </table>
          <?php endwhile; ?>
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