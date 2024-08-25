<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- button -->
                    <a href="index.php?page=register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Register</a>
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
                        <table class="table table-hover compact">
                            <thead>
                                <tr>
                                    <th class="text-center">ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Department</th>
                                    <th class="text-center">Program</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                
                                $cats = $conn->query("SELECT m.*, d.dept_name, p.prog_name FROM member m JOIN department d ON m.dept_id = d.id JOIN program p ON m.prog_id = p.id ORDER BY m.id ASC");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td><?php echo $row['studentid']; ?></td>
                                        <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td><?php echo $row['dept_name']; ?></td>
                                        <td><?php echo $row['prog_name']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
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