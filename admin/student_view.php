<?php
if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    exit();
}
$uid = $_GET['uid'];

$query = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name, 'student' as type
    FROM students s 
    LEFT JOIN department d ON s.dept_id = d.id 
    LEFT JOIN program p ON s.prog_id = p.id
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
                <div class="card-header text-bold text-center">Student Information</div>
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
                            <p type="text" class="form-control "><?= isset($data['fname']) ? $data['fname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Middle Name</p>
                            <p type="text" class="form-control "><?= isset($data['mname']) ? $data['mname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Last Name</p>
                            <p type="text" class="form-control "><?= isset($data['lname']) ? $data['lname'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Birthdate</p>
                            <p class="form-control ">
                                <?php
                                if (isset($data['bdate'])) {
                                    $date = new DateTime($data['bdate']);
                                    echo $date->format('F j, Y');
                                } else {
                                    echo '';
                                }
                                ?>
                            </p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Gender</p>
                            <p type="text" class="form-control "><?= isset($data['gender']) ? ucfirst($data['gender']) : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Address</p>
                            <p type="text" class="form-control "><?= isset($data['address']) ? $data['address'] : '' ?></p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Contact No.</p>
                            <p type="number" class="form-control "><?= isset($data['cellnum']) ? $data['cellnum'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Email</p>
                            <p type="email" class="form-control "><?= isset($data['email']) ? $data['email'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Complete Name of Parent/Guardian</p>
                            <p class="form-control "><?= isset($data['parent_name']) ? $data['parent_name'] : '' ?></p>
                        </div>
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Contact No. of Parent/Guardian</p>
                            <p class="form-control "><?= isset($data['parent_num']) ? $data['parent_num'] : '' ?></p>
                        </div>
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Address of Parent/Guardian</p>
                            <p class="form-control "><?= isset($data['parent_address']) ? $data['parent_address'] : '' ?></p>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Program/Course</p>
                            <p class="form-control "><?= isset($data['prog_name']) ? $data['prog_name'] : '' ?></p>
                        </div>

                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Department</p>
                            <p class="form-control "><?= isset($data['dept_name']) ? $data['dept_name'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">School ID</p>
                            <p class="form-control "><?= isset($data['school_id']) ? $data['school_id'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="rfid">RFID</label>
                            <input type="password" class="form-control " name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6 ">
                            <a href="index.php?page=records&uid=<?= $data['id'] ?>&type=<?= $data['type'] ?>" class="btn btn-info"><i class="fa-solid fa-clipboard"></i> Records</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="index.php?page=student_edit&uid=<?= $data['id'] ?>" class="btn btn-primary btn-custom">Edit</a>
                            <button class="btn btn-danger btn-custom archive_student" type="button" data-id="<?php echo $data['id'] ?>">Archive</button>
                            <a href="index.php?page=student_data" class="btn btn-secondary btn-custom">Back</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.archive_student').click(function() {

        _conf("Are you sure to archive this data?", "archive_student", [$(this).attr('data-id')])
    });

    function archive_student($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=archive_student',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully archive", 'warning')
                    setTimeout(function() {
                        location.href = 'index.php?page=student_data'
                    }, 1000)

                }
            }
        })
    }
</script>