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
                <div class="card-header text-bold text-center">Register Employee</div>
                <div class="card-body">
                    <form action="#" id="register">
                        <input type="hidden" name="id">



                        <div class="form-group text-right m-2">
                            <label for="img" class="mr-4">Upload Picture</label><br>
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <!-- Hidden File Input -->
                                <input type="file" name="img" id="img" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>



                        <p class="text-bold text-red"><i>Employee Information *</i></p>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control form-control-sm" name="fname" id="fname" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control form-control-sm" name="mname" id="mname" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control form-control-sm" name="lname" id="lname" required>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control form-control-sm" name="bdate" id="bdate" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control form-control-sm" name="gender" id="gender" required>
                                    <option value="" selected disabled>-- Select Gender --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>


                            <div class="col-md-2 form-group">
                                <label for="civil_stat">Civil Status</label>
                                <select class="form-control form-control-sm" name="civil_stat" id="civil_stat" required>
                                    <option value="" selected disabled>-- Select Status --</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>


                            <div class="col-md-2 form-group">
                                <label for="blood_type">Blood Type</label>
                                <select class="form-control form-control-sm" name="blood_type" id="blood_type" required>
                                    <option value="" selected disabled>-- Select Status --</option>
                                    <option value="A">A</option>
                                    <option value="A+">A+</option>
                                    <option value="A-">A-</option>
                                    <option value="B">B</option>
                                    <option value="B+">B+</option>
                                    <option value="B-">B-</option>
                                    <option value="AB">AB</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                    <option value="O">O</option>
                                    <option value="O+">O+</option>
                                </select>
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="height">Height</label>
                                <input type="number" class="form-control form-control-sm" name="height" id="height" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="weight">Weight</label>
                                <input type="number" class="form-control form-control-sm" name="weight" id="weight" required>
                            </div>
                        </div>



                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm" name="address" id="address" required>
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control form-control-sm" name="cellnum" id="cellnum" required>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="tin_num">TIN no.</label>
                                <input type="text" class="form-control form-control-sm" name="tin_num" id="tin_num">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="gsis_num">GSIS no.</label>
                                <input type="text" class="form-control form-control-sm" name="gsis_num" id="gsis_num">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="phil_num">PhilHealth no.</label>
                                <input type="text" class="form-control form-control-sm" name="phil_num" id="phil_num">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="pagibig_num">Pag-ibig no.</label>
                                <input type="text" class="form-control form-control-sm" name="pagibig_num" id="pagibig_num">
                            </div>

                            <div class="col-md-2 form-group">
                                <label for="sss_num">SSS no.</label>
                                <input type="text" class="form-control form-control-sm" name="sss_num" id="sss_num">
                            </div>

                        </div>

                        <hr>
                        <p class="text-bold text-red"><i>Contact Person Incase of Emergency *</i></p>

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

                        <hr>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control form-control-sm" name="school_id" id="school_id" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="role_id">Type</label>
                                <?php
                                $type = $conn->query("SELECT * FROM role WHERE role_name = 'employee' or 'employees' ORDER BY id ASC");
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
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control form-control-sm" name="rfid" id="rfid" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Save</button>
                            <a href="index.php?page=employee_data" class="btn btn-secondary btn-custom">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>

</div>
<script>
    $('#register').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=register2',
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
                        location.href = 'index.php?page=employee_data';
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 3) {
                    alert_toast("RFID already rigestered to someone", 'danger')
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