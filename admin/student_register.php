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
                <div class="card-header text-bold text-center">Register Student</div>
                <div class="card-body">
                    <form action="#" id="register">
                        <input type="hidden" name="id">



                        <div class="form-group text-right m-2">
                            <label for="img" class="mr-4">Profile Picture</label><br>
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <!-- Hidden File Input -->
                                <input type="file" name="img" id="img" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control form-control-sm" name="fname" id="fname" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="mname">Middle Initial</label>
                                <input type="text" class="form-control form-control-sm" name="mname" id="mname" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control form-control-sm" name="lname" id="lname" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control form-control-sm" name="bdate" id="bdate" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control-sm" name="gender" id="gender" required>
                                    <option value="" selected disabled>-- Select Gender --</option>
                                    <?php
                                    $program = $conn->query("SELECT * FROM gender order by id asc ");
                                    while ($row = $program->fetch_assoc()) :
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['gender'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm" name="address" id="address" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control form-control-sm" name="cellnum" id="cellnum" required>
                            </div>

                            <div class="col-md-4 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="parent_name">Complete Name of Parent/Guardian</label>
                                <input type="text" class="form-control form-control-sm" name="parent_name" id="parent_name" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_num">Contact No. of Parent/Guardian</label>
                                <input type="number" class="form-control form-control-sm" name="parent_num" id="parent_num" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_address">Address of Parent/Guardian</label>
                                <input type="text" class="form-control form-control-sm" name="parent_address" id="parent_address" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control form-control-sm" name="school_id" id="school_id" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="role_id">Type</label>
                                <?php
                                $type = $conn->query("SELECT * FROM role WHERE role_name = 'student' or 'students' ORDER BY id ASC");
                                while ($row = $type->fetch_assoc()) :
                                ?>
                                    <!-- Hidden input to store the role_id -->
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
                                    <option value="" selected disabled>-- Select Program/Course --</option>
                                    <?php
                                    $program = $conn->query("SELECT * FROM program ORDER BY id ASC ");
                                    while ($row = $program->fetch_assoc()) :
                                    ?>
                                        <option value="<?php echo $row['id'] ?>"><?php echo $row['prog_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="col-md-4 form-group mb-0">
                                <label for="dept_name">Department</label>
                                <!-- Hidden input to store the dept_id -->
                                <input type="hidden" name="dept_id" id="dept_id">
                                <!-- Read-only input to display the dept_name -->
                                <input class="form-control form-control-sm" type="text" name="dept_name_display" id="dept_name" readonly>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control form-control-sm" name="rfid" id="rfid" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Save</button>
                            <a href="index.php?page=student_data" class="btn btn-secondary btn-custom">Cancel</a>
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
                console.log(resp);

                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

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