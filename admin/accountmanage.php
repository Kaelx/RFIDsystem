<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <!-- button -->
                    <a href="index.php?page=adduser" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Add user</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Account Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                
                                $cats = $conn->query("select * from users;");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=accountedit&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td><?php echo ($row['account_type'] == 0) ? 'Admin' : (($row['account_type'] == 1) ? 'Staff' : 'Security Personnel'); ?></td>
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
        lengthChange: false
    });
</script>