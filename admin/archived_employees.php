<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>



    <?php
    $query = "SELECT s.id, s.fname, s.mname, s.lname, s.sname,s.email, s.school_id, r.role_name, s.rfid, s.img_path, s.gender
            FROM employees s
            LEFT JOIN role r ON s.role_id = r.id
            where status = 1;
            ";

    $result = $conn->query($query);

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-info card-outline">
                <div class="card-header text-center text-bold">Employee's Archived Data</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-25">School ID</th>
                                    <th class="text-center w-75">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=archived_employee&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['school_id'];?></td>
                                        <td class="text-left"> <?= $row['fname'] .
                                                                    (!empty($row['mname']) ? ' ' . $row['mname'] . '.' : '') .
                                                                    ' ' . $row['lname'] .
                                                                    (!empty($row['sname']) ? ' ' . $row['sname'] : '');
                                                                ?></td>
                                    </tr>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="text-right m-5">
                    <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('table').DataTable({
        ordering: false,
        stateSave: true,
        layout: {
                topStart: 'search',
                topEnd: 'pageLength',
            }
    });
</script>