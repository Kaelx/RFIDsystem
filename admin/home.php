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

        <!-- <div class="col-lg-3 col-6">
          <div class="small-box bg-primary">
            <div class="inner">
              <a href="#" style="text-decoration: none; color: inherit;">
                <?php
                $sql = $conn->query("SELECT COUNT(*) as total FROM vendors where status=0");
                $result = $sql->fetch_assoc();
                $count = $result['total'];
                ?>
                <h3><?php echo $count; ?></h3>
                <p>Canteen Vendors</p>
              </a>
            </div>
            <div class="icon">
              <i class="fa-solid fa-store"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div> -->


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

    </div>
  </section>

</div>