<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card ">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <a href="?p=vendor_register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Register</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-50">Vendor Name</th>
                                    <th class="text-center w-25">Address</th>
                                    <th class="text-center w-25">Contact No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                // Use LEFT JOIN to allow NULL values for department, program, and role
                                $cats = $conn->query("SELECT cv.*, r.role_name 
                                FROM vendors cv 
                                LEFT JOIN role r ON cv.role_id = r.id 
                                WHERE (r.role_name = 'vendor' or 'vendors' OR r.role_name IS NULL)
                                and cv.status = 0
                                ORDER BY cv.id ASC");


                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='?p=vendor_view&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . (!empty($row['mname']) ? $row['mname'] . '.' : '') . ' ' . $row['lname'] . ' ' . $row['sname']; ?></td>
                                        <td class="text-left"><?php echo $row['address']; ?></td>
                                        <td class="text-left"><?php echo $row['cellnum']; ?></td>
                                    </tr>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
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