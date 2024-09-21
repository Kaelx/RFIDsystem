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
        $bg_colors = ['bg-info', 'bg-success', 'bg-danger', 'bg-primary'];
        $counter = 0;

        
        $cats = $conn->query("SELECT r.id, r.role_name, 
                      COUNT(s.id) AS student_count,
                      COUNT(e.id) AS employee_count,
                      COUNT(v.id) AS visitor_count,
                      COUNT(cv.id) AS vendor_count,
                      (COUNT(s.id) + COUNT(e.id) + COUNT(v.id) + COUNT(cv.id)) AS total_count
                FROM role r
                LEFT JOIN students s ON s.role_id = r.id AND s.status = 0
                LEFT JOIN employees e ON e.role_id = r.id AND e.status = 0
                LEFT JOIN visitors v ON v.role_id = r.id AND v.status = 0
                LEFT JOIN vendors cv ON cv.role_id = r.id AND cv.status = 0
                GROUP BY r.id, r.role_name
            ");
    



        while ($row = $cats->fetch_assoc()):
          $bg_color = $bg_colors[$counter % count($bg_colors)];
          $counter++;
        ?>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box <?php echo $bg_color; ?>">
              <div class="inner">
                <!-- Display the count of members -->
                <h3><?php echo $row['total_count']; ?></h3>

                <p><?php echo $row['role_name'] ?></p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

        <?php endwhile; ?>

      </div>

    </div>
  </section>

</div>