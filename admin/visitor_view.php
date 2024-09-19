<?php
if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    header('Location: index.php?page=visitor_data');
}
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT s.*, r.role_name
    FROM visitors s 
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

    $data = mysqli_fetch_assoc($query);

?>

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
                <div class="card-header text-bold text-center">Visitor Information</div>
                <div class="card-body">
                    <div class="form-group text-right mb-0 mr-5">
                        <div style="position: relative; display: inline-block;">
                            <?php if (isset($data['img_path']) && !empty($data['img_path'])): ?>
                                <img src="<?= 'assets/img/' . $data['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                            <?php else: ?>
                                <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">First Name</p>
                            <p type="text" class="form-control form-control-sm"><?= isset($data['fname']) ? $data['fname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Middle Name</p>
                            <p type="text" class="form-control form-control-sm"><?= isset($data['mname']) ? $data['mname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Last Name</p>
                            <p type="text" class="form-control form-control-sm"><?= isset($data['lname']) ? $data['lname'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Birthdate</p>
                            <p type="date" class="form-control form-control-sm"><?= isset($data['bdate']) ? $data['bdate'] : '' ?></p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Gender</p>
                            <p type="text" class="form-control form-control-sm"><?= isset($data['gender']) ? ucfirst($data['gender']) : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Address</p>
                            <p type="text" class="form-control form-control-sm"><?= isset($data['address']) ? $data['address'] : '' ?></p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Contact No.</p>
                            <p type="number" class="form-control form-control-sm"><?= isset($data['cellnum']) ? $data['cellnum'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Email</p>
                            <p type="email" class="form-control form-control-sm"><?= isset($data['email']) ? $data['email'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Complete Name of Parent/Guardian</p>
                            <p class="form-control form-control-sm"><?= isset($data['parent_name']) ? $data['parent_name'] : '' ?></p>
                        </div>
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Contact No. of Parent/Guardian</p>
                            <p class="form-control form-control-sm"><?= isset($data['parent_num']) ? $data['parent_num'] : '' ?></p>
                        </div>
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Address of Parent/Guardian</p>
                            <p class="form-control form-control-sm"><?= isset($data['parent_address']) ? $data['parent_address'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">

                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Type</p>
                            <p class="form-control form-control-sm" readonly><?= isset($data['role_name']) ? $data['role_name'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="rfid">RFID</label>
                            <input type="password" class="form-control form-control-sm" name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6 ">
                            <a href="index.php?page=records&rfid=<?= $data['rfid'] ?>" class="btn btn-info">Records</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?page=visitor_edit&uid=<?= $data['id'] ?>" class="btn btn-primary btn-custom">Update</a>
                            <button class="btn btn-danger btn-custom delete_visitor" type="button" data-id="<?php echo $data['id'] ?>">Delete</button>
                            <a href="index.php?page=visitor_data" class="btn btn-secondary btn-custom">Back</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.delete_visitor').click(function() {

        _conf("Are you sure to delete this data?", "delete_visitor", [$(this).attr('data-id')])
    });

    function delete_visitor($id) {
        $.ajax({
            url: 'ajax.php?action=delete_visitor',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'warning')
                    setTimeout(function() {
                        location.href = 'index.php?page=visitor_data'
                    }, 1000)

                }
            }
        })
    }
</script>