<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>



    <?php
    $query = "SELECT s.id, s.fname, s.mname, s.lname,s.email, r.role_name, s.rfid, s.img_path, s.gender
            FROM visitors s
            LEFT JOIN role r ON s.role_id = r.id
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
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $result->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=archived_visitor&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td><?= $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td><?= $row['email'] ?></td>
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