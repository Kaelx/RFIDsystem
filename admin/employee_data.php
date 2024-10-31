<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <div class="row">
                        <div class="col-sm-6">
                            <a href="index.php?page=employee_register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Register</a>
                            <!-- <a href="index.php?page=import" class="btn btn-secondary"><i class="fa-solid fa-file-import"></i> Import</a> -->
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-25">School ID</th>
                                    <th class="text-center w-75">Employee Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                $cats = $conn->query("SELECT e.*, r.role_name 
                                                    FROM employees e
                                                    LEFT JOIN role r ON e.role_id = r.id 
                                                    WHERE (r.role_name = 'employee' or 'employees'OR r.role_name IS NULL)
                                                    and e.status = 0
                                                    ORDER BY e.id ASC");

                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=employee_view&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?php echo $row['school_id']; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . (!empty($row['mname']) ? $row['mname'] . '.' : '') . ' ' . $row['lname'] . ' ' . $row['sname']; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <!-- Department Section -->
            <div class="row">
                <?php
                $sql = $conn->query("SELECT d.*, COUNT(CASE WHEN e.status = 0 THEN 1 END) AS employee_count 
                    FROM department d
                    LEFT JOIN employees e ON d.id = e.dept_id
                    GROUP BY d.id
                ");

                while ($result = $sql->fetch_assoc()) {
                ?>
                    <div class="col-md-3 col-sm-6 col-12">
                        <a href="index.php?page=department_data&department=<?= $result['id']; ?>" style="text-decoration: none; color: inherit;">
                            <div class="info-box">
                                <span class="info-box-icon text-white" style="background-color: <?= $result['color']; ?>"><i class="fa-solid fa-building"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text"><?= $result['dept_name']; ?></span>
                                    <span class="info-box-number"><?= !empty($result['employee_count']) ? $result['employee_count'] : '0'; ?></span>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </section>
</div>
<script>
    $('table').DataTable({
        ordering: false,
        lengthChange: false,
        stateSave: true
    });
</script>