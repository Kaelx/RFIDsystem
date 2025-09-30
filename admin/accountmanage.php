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
                    <div class="text-right">
                        <div>
                            <a href="?p=accountadduser" class="btn btn-primary mr-3"><i class="fa-solid fa-user-pen"></i> Add user</a>
                            <a href="?p=accountmanage_archive" class="btn btn-info"><i class="fa-solid fa-file-zipper"></i> Archived</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Employee ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Account Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                $login_id = $_SESSION['login_id'];

                                $cats = $conn->query("SELECT * FROM users WHERE account_type != 0 AND status = 0 AND id != $login_id;");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='?p=accountedit&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class="text-center"><?php echo $row['school_id']; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . (!empty($row['mname']) ? $row['mname'] . '.' : '') . ' ' . $row['lname'] . ' ' . $row['sname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo ($row['account_type'] == 1) ? 'Admin' : (($row['account_type'] == 2) ? 'Staff' : 'Security Personnel'); ?></td>
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
        layout: {
            topStart: 'search',
            topEnd: null,
        }
    });

    $('#archive_user').click(function() {
        alert('Archive');
    });
</script>