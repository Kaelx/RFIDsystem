<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- button -->
                    <a href="index.php?page=adduser" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Add user</a>
                    <button type="button" class="btn btn-secondary"><i class="fa-solid fa-file-import"></i> Import</button>
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
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Username</th>
                                    <th class="text-center">Account Type</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                // Modify the SQL query with appropriate JOIN conditions
                                $cats = $conn->query("select * from users;");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td><?php echo (!empty($row['email'])) ? $row['email'] : 'N/A'; ?></td>
                                        <td><?php echo $row['username']; ?></td>
                                        <td><?php echo ($row['type'] == 0) ? 'Admin' : (($row['type'] == 1) ? 'Staff' : 'Security Personnel'); ?></td>
                                        <td class="text-center">
                                            <a href="index.php?page=view&uid=<?= $row['id'] ?>" class="btn btn-success btn-sm"><i class="fa fa-eye"></i> view</a>
                                        </td>
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
    });
</script>