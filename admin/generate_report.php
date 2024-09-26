<?php

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';


$query = "SELECT r.id, r.timein, r.timeout, 
        COALESCE(s.fname, e.fname, v.fname) AS fname, 
        COALESCE(s.mname, e.mname, v.mname) AS mname, 
        COALESCE(s.lname, e.lname, v.lname) AS lname,
        COALESCE(s.school_id, e.school_id, NULL) AS school_id,
        COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name
    FROM records r
    LEFT JOIN students s ON r.recordable_id = s.id AND r.recordable_table = 'students'
    LEFT JOIN employees e ON r.recordable_id = e.id AND r.recordable_table = 'employees'
    LEFT JOIN visitors v ON r.recordable_id = v.id AND r.recordable_table = 'visitors'
    LEFT JOIN role r_s ON s.role_id = r_s.id
    LEFT JOIN role r_e ON e.role_id = r_e.id
    LEFT JOIN role r_v ON v.role_id = r_v.id
    WHERE COALESCE(s.status, e.status, v.status) = 0
";

// Add date filter if both dates are set
if (!empty($start_date) && !empty($end_date)) {
  $query .= " AND DATE(r.timein) BETWEEN '$start_date' AND '$end_date'
                AND DATE(r.timeout) BETWEEN '$start_date' AND '$end_date'";
}

$cats = $conn->query($query);

?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
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
            <h2 class="page-header">
              <i class="fas fa-globe"></i> AdminLTE, Inc.
              <small class="float-right">Date: 2/10/2014</small>
            </h2>
          </div>
        </div>
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            From
            <address>
              <strong>Admin, Inc.</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (804) 123-5432<br>
              Email: info@almasaeedstudio.com
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            To
            <address>
              <strong>John Doe</strong><br>
              795 Folsom Ave, Suite 600<br>
              San Francisco, CA 94107<br>
              Phone: (555) 539-1037<br>
              Email: john.doe@example.com
            </address>
          </div>
          <!-- /.col -->
          <div class="col-sm-4 invoice-col">
            <b>Invoice #007612</b><br>
            <br>
            <b>Order ID:</b> 4F3S8J<br>
            <b>Payment Due:</b> 2/22/2014<br>
            <b>Account:</b> 968-34567
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="table-responsive">
            <table class="table table-hover table-bordered compact">
              <thead>
                <tr>
                  <th class="text-center">#</th>
                  <th class="text-center">School ID</th>
                  <th class="text-center">Name</th>
                  <th class="text-center">Role</th>
                  <th class="text-center">Time in</th>
                  <th class="text-center">Time out</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $i = 1;
                while ($row = $cats->fetch_assoc()):
                ?>
                  <tr>
                    <td class="text-center"><?= $i++; ?></td>
                    <td class="text-left"><?php echo (isset($row['school_id']) ? $row['school_id'] : 'Visitor'); ?></td>
                    <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                    <td class="text-left"><?php echo $row['role_name']; ?></td>
                    <td class="text-center">
                      <?php
                      $timein = new DateTime($row['timein']);
                      echo $timein->format('F j, Y -- h:i A');
                      ?>
                    </td>
                    <td class="text-center">
                      <?php
                      if (!empty($row['timeout'])) {
                        $timeout = new DateTime($row['timeout']);
                        echo $timeout->format('F j, Y -- h:i A');
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
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
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