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


                        <div class="form-group text-right m-2">
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
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control form-control-sm" name="fname" id="fname" required value="<?= isset($data['fname']) ? $data['fname'] : '' ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mname">Middle Initial</label>
                                <input type="text" class="form-control form-control-sm" name="mname" id="mname" required value="<?= isset($data['mname']) ? $data['mname'] : '' ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control form-control-sm" name="lname" id="lname" required value="<?= isset($data['lname']) ? $data['lname'] : '' ?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control form-control-sm" name="bdate" id="bdate" required value="<?= isset($data['bdate']) ? $data['bdate'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control-sm" name="gender" id="gender" required>
                                    <option value="" <?= !isset($data['gender_id']) || $data['gender_id'] == '' ? 'selected' : '' ?> disabled>-- Select Role --</option>
                                    <?php
                                    $type = $conn->query("SELECT * FROM gender ORDER BY id ASC");
                                    while ($row = $type->fetch_assoc()) :
                                        $selected = isset($data['gender_id']) && $data['gender_id'] == $row['id'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['gender'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm" name="address" id="address" required value="<?= isset($data['address']) ? $data['address'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control form-control-sm" name="cellnum" id="cellnum" required value="<?= isset($data['cellnum']) ? $data['cellnum'] : '' ?>">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="parent_name">Complete Name of Parent/Guardian</label>
                                <input type="text" class="form-control form-control-sm" name="parent_name" id="parent_name" required value="<?= isset($data['parent_name']) ? $data['parent_name'] : '' ?>">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_num">Contact No. of Parent/Guardian</label>
                                <input type="number" class="form-control form-control-sm" name="parent_num" id="parent_num" required value="<?= isset($data['parent_num']) ? $data['parent_num'] : '' ?>">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_address">Address of Parent/Guardian</label>
                                <input type="text" class="form-control form-control-sm" name="parent_address" id="parent_address" required value="<?= isset($data['parent_address']) ? $data['parent_address'] : '' ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control form-control-sm" name="school_id" id="school_id" required value="<?= isset($data['school_id']) ? $data['school_id'] : '' ?>">
                            </div>






                            <div class="col-md-4 form-group">
                                <?php
                                $type = $conn->query("SELECT * FROM role WHERE role_name = 'Student' ORDER BY id ASC");
                                while ($row = $type->fetch_assoc()) :
                                ?>
                                    <label for="role_id">Type</label>
                                    <input type="hidden" name="role_id" value="<?= $row['id'] ?>">

                                    <!-- Read-only input to display the role_name -->
                                    <input type="text" class="form-control form-control-sm" id="role_id" value="<?= $row['role_name'] ?>" readonly>
                                <?php endwhile; ?>
                            </div>


                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="prog_id">School Program/Course</label>
                                <select class="form-control form-control-sm" name="prog_id" id="prog_id" required>
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

                            <div class="col-md-4 form-group">
                                <label for="dept_name">Department</label>
                                <input type="hidden" class="form-control form-control-sm" name="dept_id" id="dept_id" required value="<?= isset($data['dept_id']) ? $data['dept_id'] : '' ?>">
                                <input type="text" class="form-control form-control-sm" id="dept_name" required value="<?= isset($data['dept_name']) ? $data['dept_name'] : '' ?>" readonly>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control form-control-sm" name="rfid" id="rfid" required value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>">
                            </div>
                        </div>
                        <div class="text-center mr-5">
                            <button type="submit" class="btn btn-primary btn-custom">Save</button>
                            <a href="index.php?page=student_view&uid=<?= $data['id']?>" class="btn btn-secondary btn-custom">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>

</div>

<script>
    $('#prog_id').change(function() {
        var prog_id = $(this).val();

        $.ajax({
            url: 'ajax.php?action=get_department',
            type: 'POST',
            data: {
                prog_id: prog_id
            },
            success: function(response) {
                var result = JSON.parse(response);

                console.log(response);

                // Set the hidden dept_id
                $('#dept_id').val(result.dept_id);
                // Set the visible dept_name
                $('#dept_name').val(result.dept_name);

            }
        });
    });





    $('#register').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=register',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {

                console.log("Response: ", resp); //to see the error


                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.href = 'index.php?page=student_data'
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.href = 'index.php?page=student_view&uid=' + <?= $data['id'] ?>
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })




    // When the image is clicked, trigger the file input click event
    document.getElementById('profileImage').onclick = function() {
        document.getElementById('img').click();
    };

    // Preview the selected image before uploading
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('profileImage');
            output.src = reader.result; // Display the selected image as preview
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>