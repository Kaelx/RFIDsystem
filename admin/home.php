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
        <div class="col-lg-3 col-6">
          <div class="small-box bg-info">
            <div class="inner">
              <?php
              if (isset($_SESSION['login_account_type']) && ($_SESSION['login_account_type'] == 1 || $_SESSION['login_account_type'] == 2)):
              ?>
                <a href="index.php?page=employee_data" style="text-decoration: none; color: inherit;">

                <?php endif; ?>

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
            <p class="small-box-footer"><i class="fa-solid fa-circle-info"></i></p>
          </div>
        </div>


        <div class="col-lg-3 col-6">
          <div class="small-box bg-success">
            <div class="inner">
              <?php
              if (isset($_SESSION['login_account_type']) && ($_SESSION['login_account_type'] == 1 || $_SESSION['login_account_type'] == 2)):
              ?>
                <a href="index.php?page=student_data" style="text-decoration: none; color: inherit;">

                <?php endif; ?>
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
            <p class="small-box-footer"><i class="fa-solid fa-circle-info"></i></p>
          </div>

        </div>



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
            <p class="small-box-footer"><i class="fa-solid fa-circle-info"></i></p>
          </div>
        </div>


      </div>




      <div class="row mt-2">
        <div class="col-md-12">
          <!-- LINE CHART -->
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Line Graph (Past 7 days)</h3>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="lineChart" style="min-height: 200px; height: 200px; max-height: 200px; max-width: 100%;"></canvas>
              </div>
            </div>
          </div>

        </div>
      </div>


      <div class="row mt-2">
        <div class="col-md-12">
          <!-- BAR CHART -->
          <div class="card">
            <div class="card-header">
              <p class="card-title">Bar Graph <?php echo '( Year ' . date("Y") . ' )'; ?></p>
            </div>
            <div class="card-body">
              <div class="chart">
                <canvas id="barChart" style="min-height: 200PX; height: 200PX; max-height: 200PX; max-width: 100%;"></canvas>
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
    var data = <?php echo json_encode($data); ?>; //[0, 10, 5, 2, 20];
    var labels = <?php echo json_encode($labels); ?>; //['October 3, 2021', 'October 4, 2021', 'October 5, 2021', 'October 6, 2021', 'October 7, 2021' ];



    //-------------
    //- LINE CHART -
    //-------------
    // Set up current date and seven days ago
    var currentDate = new Date();
    var sevenDaysAgo = new Date();
    sevenDaysAgo.setDate(currentDate.getDate() - 8);


    var filteredData = [];
    var filteredLabels = [];

    for (var i = 0; i < labels.length; i++) {
      var entryDate = new Date(labels[i]);

      if (entryDate >= sevenDaysAgo && entryDate <= currentDate) {
        filteredLabels.push(labels[i]);
        filteredData.push(data[i]);
      }
    }

    var lineChartCanvas = $('#lineChart').get(0).getContext('2d');
    var currentDate = new Date();


    var lineChartData = {
      labels: filteredLabels,
      datasets: [{
        label: 'Entries',
        backgroundColor: 'rgba(60,141,188,0.9)',
        borderColor: 'rgba(60,141,188,0.8)',
        pointRadius: false,
        pointColor: '#3b8bba',
        pointStrokeColor: 'rgba(60,141,188,1)',
        pointHighlightFill: '#fff',
        pointHighlightStroke: 'rgba(60,141,188,1)',
        data: filteredData,
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
            beginAtZero: true,
            stepSize: 10
          }
        }]
      }
    };


    new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    });



    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')

    var currentYear = new Date().getFullYear();
    var monthLabels = [
      'January', 'February', 'March', 'April', 'May', 'June',
      'July', 'August', 'September', 'October', 'November', 'December'
    ];

    var monthlyData = new Array(12).fill(0);

    labels.forEach((label, index) => {
      var date = new Date(label);
      var year = date.getFullYear();
      var month = date.getMonth();

      if (year === currentYear) {
        var value = parseFloat(data[index]) || 0;
        monthlyData[month] += value;
      }
    });


    var barChartData = {
      labels: monthLabels,
      datasets: [{
        label: 'Entries',
        backgroundColor: '#0073b7',
        borderColor: '#0073b7',
        borderWidth: 1,
        data: monthlyData
      }]
    }

    var barChartOptions = {
      responsive: true,
      maintainAspectRatio: false,
      datasetFill: false,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: false,
          }
        }],
        yAxes: [{
          gridLines: {
            display: true,
          },
          ticks: {
            beginAtZero: true,
            stepSize: 10
          }
        }]
      }

    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })



  });
</script>