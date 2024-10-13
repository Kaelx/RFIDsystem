<?php

$sql = "SELECT COUNT(*) as count, record_date FROM records GROUP BY record_date";
$result = $conn->query($sql);

$data = [];
$labels = [];

// Fetch data
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $Date = date('F j, Y', strtotime($row['record_date']));
    $labels[] = $Date;
    $data[] = $row['count'];
  }
} else {
  $data = [0];
  $labels = ['No data'];
}

?>


<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1 class="m-0">Dashboard</h1>
        </div>
      </div>
    </div>
  </div>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">

      <!-- Small boxes (Stat box) -->
      <div class="row">

        <?php
        if (isset($_SESSION['login_account_type']) && ($_SESSION['login_account_type'] == 1 || $_SESSION['login_account_type'] == 2)):
        ?>
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info">
              <div class="inner">
                <a href="index.php?page=employee_data" style="text-decoration: none; color: inherit;">

                  <?php
                  $sql = $conn->query("SELECT COUNT(*) as total FROM employees where status=0");
                  $result = $sql->fetch_assoc();
                  $count = $result['total'];
                  ?>
                  <h3><?php echo $count; ?></h3>
                  <p>Employee</p>
                </a>
              </div>
              <div class="icon">
                <i class="fa-solid fa-user-tie"></i>
              </div>
              <a href="index.php?page=employee_data" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>


          <div class="col-lg-3 col-6">
            <div class="small-box bg-success">
              <div class="inner">
                <a href="index.php?page=student_data" style="text-decoration: none; color: inherit;">
                  <?php
                  $sql = $conn->query("SELECT COUNT(*) as total FROM students where status=0");
                  $result = $sql->fetch_assoc();
                  $count = $result['total'];
                  ?>
                  <h3><?php echo $count; ?></h3>
                  <p>Students</p>
                </a>
              </div>
              <div class="icon">
                <i class="fa-solid fa-graduation-cap"></i>
              </div>
              <a href="index.php?page=student_data" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>

          </div>

        <?php endif; ?>



        <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <a href="index.php?page=visitor_data" style="text-decoration: none; color: inherit;">
                <?php
                $sql = $conn->query("SELECT COUNT(*) as total FROM visitors where status=0");
                $result = $sql->fetch_assoc();
                $count = $result['total'];
                ?>
                <h3><?php echo $count; ?></h3>
                <p>Visitors</p>
              </a>
            </div>
            <div class="icon">
              <i class="fa-solid fa-person-walking"></i>
            </div>
            <a href="index.php?page=visitor_data" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


      </div>




      <div class="row mt-2">
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Entry Graph</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

        </div>
      </div>


    </div>
  </section>

</div>



<script>
  $(function() {
    var data = <?php echo json_encode($data); ?>;
    var labels = <?php echo json_encode($labels); ?>;

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d');

    var lineChartData = {
      labels: labels,
      datasets: [{
        label: 'Entries',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: data,
        fill: false
      }]
    };

    var lineChartOptions = {
      maintainAspectRatio: false,
      responsive: true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: true,
          }
        }],
        yAxes: [{
          gridLines: {
            display: false,
          },
          ticks: {
            beginAtZero: true
          }
        }]
      }
    };


    new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });
  });
</script>