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
                            <!-- button -->
                            <a href="index.php?page=accountadduser" class="btn btn-primary mr-3"><i class="fa-solid fa-user-pen"></i> Add user</a>
                            <a href="index.php?page=accountmanage_archive" class="btn btn-info"><i class="fa-solid fa-file-zipper"></i> Archived</a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
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

                                $login = $_SESSION['login_id'];

                                $cats = $conn->query("select * from users where id != $login and status = 0;");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=accountedit&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class="text-center"><?php echo $row['school_id'];?></td>
                                        <td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></td>
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
        lengthChange: false
    });

    $('#archive_user').click(function(){
        alert('Archive');
    });
</script>