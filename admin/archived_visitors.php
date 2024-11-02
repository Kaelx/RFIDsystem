<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>



    <?php
    $query = "SELECT v.id, v.fname, v.mname, v.lname, v.sname,v.address, v.cellnum, r.role_name, v.rfid, v.img_path, v.gender
            FROM visitors v
            LEFT JOIN role r ON v.role_id = r.id
            where status = 1;
            ";

    $result = $conn->query($query);

    ?>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header text-center text-bold">Visitor's Archived Data</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-50">Name</th>
                                    <th class="text-center w-25">Address</th>
                                    <th class="text-center w-25">Contact No.</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=archived_visitor&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . (!empty($row['mname']) ? $row['mname'] . '.' : '') . ' ' . $row['lname'] . ' ' . $row['sname']; ?></td>
                                        <td class="text-left"><?= $row['address'] ?></td>
                                        <td class="text-left"><?= $row['cellnum'] ?></td>
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