<?php

if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    header('Location: index.php?page=employee_data');
}

$uid = $_GET['uid'];

$query = $conn->query("SELECT e.*, r.role_name, 'employees' as type
    FROM employees e
    LEFT JOIN role r ON e.role_id = r.id 
    WHERE e.id = $uid 
    ORDER BY e.id ASC");

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
                <div class="card-header text-bold text-center">Employee Information</div>
                <div class="card-body">
                    <form action="#" id="register">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

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

                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Civil Status</p>
                                <p type="text" class="form-control form-control-sm"><?= isset($data['civil_stat']) ? $data['civil_stat'] : '' ?></p>
                            </div>
                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Blood Type</p>
                                <p type="text" class="form-control form-control-sm"><?= isset($data['blood_type']) ? $data['blood_type'] : '' ?></p>
                            </div>
                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Height</p>
                                <p type="text" class="form-control form-control-sm"><?= isset($data['height']) ? $data['height'] : '' ?></p>
                            </div>
                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Weight</p>
                                <p type="text" class="form-control form-control-sm"><?= isset($data['weight']) ? $data['weight'] : '' ?></p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 form-group mb-0">
                                <p class="mb-2 text-bold">Address</p>
                                <p type="text" class="form-control form-control-sm"><?= isset($data['address']) ? $data['address'] : '' ?></p>
                            </div>
                            <div class="col-md-3 form-group mb-0">
                                <p class="mb-2 text-bold">Contact No.</p>
                                <p type="number" class="form-control form-control-sm"><?= isset($data['cellnum']) ? $data['cellnum'] : '' ?></p>
                            </div>

                            <div class="col-md-3 form-group mb-0">
                                <p class="mb-2 text-bold">Email</p>
                                <p type="email" class="form-control form-control-sm"><?= isset($data['email']) ? $data['email'] : '' ?></p>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">TIN No.</p>
                                <p class="form-control form-control-sm"><?= isset($data['tin_num']) ? $data['tin_num'] : '' ?></p>
                            </div>
                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">GSIS No.</p>
                                <p class="form-control form-control-sm" id="gsis_num"><?= isset($data['gsis_num']) ? $data['gsis_num'] : '' ?></p>
                            </div>

                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Philhealth No.</p>
                                <p class="form-control form-control-sm" id="phil_num"><?= isset($data['phil_num']) ? $data['phil_num'] : '' ?></p>
                            </div>

                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">Pag-ibig No.</p>
                                <p class="form-control form-control-sm" id="pagibig_num"><?= isset($data['pagibig_num']) ? $data['pagibig_num'] : '' ?></p>
                            </div>

                            <div class="col-md-2 form-group mb-0">
                                <p class="mb-2 text-bold">SSS No.</p>
                                <p type="email" class="form-control form-control-sm" id="tin_num"><?= isset($data['sss_num']) ? $data['sss_num'] : '' ?></p>
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
                                <p class="mb-2 text-bold">School ID</p>
                                <p class="form-control form-control-sm"><?= isset($data['school_id']) ? $data['school_id'] : '' ?></p>
                            </div>

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
                    </form>

                    <div class="row">
                        <div class="col-md-6 ">
                            <a href="index.php?page=records&uid=<?= $data['id'] ?>&type=<?= $data['type']?>" class="btn btn-info">Records</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?page=employee_edit&uid=<?= $data['id'] ?>" class="btn btn-primary btn-custom">Update</a>
                            <button class="btn btn-danger btn-custom archive_employee" type="button" data-id="<?php echo $data['id'] ?>">Archive</button>
                            <a href="index.php?page=employee_data" class="btn btn-secondary btn-custom">Back</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.archive_employee').click(function() {

        _conf("Are you sure to archive this data?", "archive_employee", [$(this).attr('data-id')])
    });

    function archive_employee($id) {
        $.ajax({
            url: 'ajax.php?action=archive_employee',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully archive", 'warning')
                    setTimeout(function() {
                        location.href = 'index.php?page=employee_data'
                    }, 1000)

                }
            }
        })
    }
</script>