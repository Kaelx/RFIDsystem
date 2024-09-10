<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name 
    FROM students s 
    LEFT JOIN department d ON s.dept_id = d.id 
    LEFT JOIN program p ON s.prog_id = p.id 
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

    $data = mysqli_fetch_assoc($query);
} else {
    header('location: index.php?page=student_data');
}
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
                    <form action="#" id="register">
                        <input type="hidden" name="id" value="<?= isset($data['id']) ? $data['id'] : '' ?>">

                        <div class="form-group text-right mr-4">
                            <label for="img" class="mr-4">Profile Picture</label><br>
                            <div style="position: relative; display: inline-block;">
                                <?php if (isset($data['img_path']) && !empty($data['img_path'])): ?>
                                    <img src="<?= 'assets/img/' . $data['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <?php else: ?>
                                    <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <?php endif; ?>

                                <!-- Hidden File Input -->
                                <input type="file" name="img" id="img" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" name="fname" id="fname" value="<?= isset($data['fname']) ? $data['fname'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mname">Middle Initial</label>
                                <input type="text" class="form-control" name="mname" id="mname" value="<?= isset($data['mname']) ? $data['mname'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" name="lname" id="lname" value="<?= isset($data['lname']) ? $data['lname'] : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control" name="bdate" id="bdate" value="<?= isset($data['bdate']) ? $data['bdate'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control" name="gender" id="gender" disabled>
                                    <option value="" <?= !isset($data['gender']) || $data['gender'] == '' ? 'selected' : '' ?> disabled>-- Select Role --</option>
                                    <?php
                                    $type = $conn->query("SELECT * FROM gender ORDER BY id ASC");
                                    while ($row = $type->fetch_assoc()) :
                                        $selected = isset($data['gender']) && $data['gender'] == $row['id'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['gender'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control" name="address" id="address" value="<?= isset($data['address']) ? $data['address'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control" name="cellnum" id="cellnum" value="<?= isset($data['cellnum']) ? $data['cellnum'] : '' ?>" readonly>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?= isset($data['email']) ? $data['email'] : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="parent_name">Complete Name of Parent/Guardian</label>
                                <input type="text" class="form-control" name="parent_name" id="parent_name" value="<?= isset($data['parent_name']) ? $data['parent_name'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_num">Contact No. of Parent/Guardian</label>
                                <input type="number" class="form-control" name="parent_num" id="parent_num" value="<?= isset($data['parent_num']) ? $data['parent_num'] : '' ?>" readonly>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_address">Address of Parent/Guardian</label>
                                <input type="text" class="form-control" name="parent_address" id="parent_address" value="<?= isset($data['parent_address']) ? $data['parent_address'] : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control" name="school_id" id="school_id" value="<?= isset($data['school_id']) ? $data['school_id'] : '' ?>" readonly>
                            </div>

                            <div class="col-md-4 form-group">
                                <?php
                                $type = $conn->query("SELECT * FROM role WHERE role_name = 'Student' ORDER BY id ASC");
                                while ($row = $type->fetch_assoc()) :
                                ?>
                                    <label for="role_id">Type</label>
                                    <input type="hidden" name="role_id" value="<?= $row['id'] ?>">
                                    <input type="text" class="form-control" id="role_id" value="<?= $row['role_name'] ?>" readonly>
                                <?php endwhile; ?>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="prog_id">School Program/Course</label>
                                <select class="form-control" name="prog_id" id="prog_id" disabled>
                                    <option value="" <?= !isset($data['prog_id']) || $data['prog_id'] == '' ? 'selected' : '' ?> disabled>-- Select Role --</option>
                                    <?php
                                    $type = $conn->query("SELECT * FROM program ORDER BY id ASC");
                                    while ($row = $type->fetch_assoc()) :
                                        $selected = isset($data['prog_id']) && $data['prog_id'] == $row['id'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['prog_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label for="dept_name">Department</label>
                                <input type="hidden" class="form-control" name="dept_id" id="dept_id" value="<?= isset($data['dept_id']) ? $data['dept_id'] : '' ?>" readonly>
                                <input type="text" class="form-control" id="dept_name" value="<?= isset($data['dept_name']) ? $data['dept_name'] : '' ?>" readonly>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control" name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                            </div>
                        </div>
                    </form>

                    <div class="row">
                        <div class="col-md-4 text-left">
                            <a href="index.php?page=student_print&uid=<?= $data['id'] ?>" class="btn btn-primary btn-custom">Print</a>
                        </div>

                        <div class="col-md-8 text-right">
                            <a href="index.php?page=student_edit&uid=<?= $data['id'] ?>" class="btn btn-primary btn-custom">Update</a>
                            <button class="btn btn-danger btn-custom delete_student" type="button" data-id="<?php echo $data['id'] ?>">Delete</button>
                            <a href="index.php?page=student_data" class="btn btn-secondary btn-custom">Back</a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.delete_student').click(function() {

        _conf("Are you sure to delete this data?", "delete_student", [$(this).attr('data-id')])
    });

    function delete_student($id) {
        $.ajax({
            url: 'ajax.php?action=delete_student',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'warning')
                    setTimeout(function() {
                        location.href = 'index.php?page=student_data'
                    }, 1500)

                }
            }
        })
    }
</script>