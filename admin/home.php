<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
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

        // Modify the query to count members per category
        $cats = $conn->query("SELECT *, COUNT(m.id) AS count
          FROM role r
          LEFT JOIN member m ON m.role_id = r.id
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
                <h3><?php echo $row['count']; ?></h3>

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