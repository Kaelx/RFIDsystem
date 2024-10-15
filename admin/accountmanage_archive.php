<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Archived User</h1>
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
                                    <th class="text-center">Employee ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Email</th>
                                    <th class="text-center">Account Type</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;

                                $login = $_SESSION['login_id'];

                                $cats = $conn->query("select * from users where id != $login and status = 1;");
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?php echo $i++; ?></td>
                                        <td class="text-center"><?php echo $row['school_id'];?></td>
                                        <td><?php echo $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']; ?></td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo ($row['account_type'] == 1) ? 'Admin' : (($row['account_type'] == 2) ? 'Staff' : 'Security Personnel'); ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-danger btn-sm unarchive_user" data-id="<?php echo $row['id'] ?>"><i class="fa-solid fa-arrow-rotate-left"></i> Restore</button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="text-right">
                    <button type="button" class="btn btn-secondary m-3 mr-5 btn-custom" onclick="window.history.back(); return false;">Back</button>
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

    $('.unarchive_user').click(function() {

        _conf("Are you sure to unarchive this data?", "unarchive_user", [$(this).attr('data-id')])
    });


    function unarchive_user($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=unarchive_user',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                console.log(resp);

                if (resp == 1) {
                    alert_toast("Data successfully unarchived", 'success')
                    setTimeout(function() {
                        location.reload();
                    }, 1000)
                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    }
</script>