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
                            <a href="index.php?page=student_register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Register</a>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-25">School ID</th>
                                    <th class="text-center w-50">Name</th>
                                    <th class="text-center w-25">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                // Use LEFT JOIN to allow NULL values for department, program, and role
                                $cats = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name 
                                                FROM students s 
                                                LEFT JOIN department d ON s.dept_id = d.id 
                                                LEFT JOIN program p ON s.prog_id = p.id 
                                                LEFT JOIN role r ON s.role_id = r.id 
                                                WHERE (r.role_name = 'student' or 'students' OR r.role_name IS NULL)
                                                and s.status = 0
                                                ORDER BY s.id ASC");

                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=student_view&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-left"><?php echo $row['school_id']; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td class="text-left"><?php echo $row['email']; ?></td>
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
                $sql = $conn->query("SELECT d.*, COUNT(CASE WHEN s.status = 0 THEN 1 END) AS student_count 
                    FROM department d
                    LEFT JOIN students s ON d.id = s.dept_id
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
                                    <span class="info-box-number"><?= !empty($result['student_count']) ? $result['student_count'] : '0'; ?></span>
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