<style>
    #profileImage {
        cursor: pointer;
        border-radius: 50%;
        transition: opacity 0.3s ease-in-out;
    }

    .form-group div::after {
        content: 'Upload';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
        opacity: 0;
        transition: opacity 0.3s ease-in-out;
        pointer-events: none;
    }

    .form-group div:hover::after {
        opacity: 1;
    }

    .form-group div:hover #profileImage {
        opacity: 0.7;
    }
</style>


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



                        <!-- HTML Section -->
                        <div class="form-group text-right mb-0 mr-5">
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <input type="hidden" id="croppedImageData" name="croppedImageData">
                            </div>
                        </div>

                        <!-- modal -->
                        <div class="modal fade" id="modal-default" data-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Choose Image</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <input type="file" name="img" id="img" accept="image/*" class="form-control mb-3" onchange="previewImage(event)">
                                        <div class="img-fluid">
                                            <img id="modalImg" src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Image Preview" class="img-fluid rounded" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" id="btnCrop">Crop & Save</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            $('#profileImage').on('click', function() {
                                $('#modal-default').modal('show');
                            });

                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('modalImg');
                                    output.src = reader.result;
                                    initializeCropper();
                                };
                                reader.readAsDataURL(event.target.files[0]);
                            }

                            function initializeCropper() {
                                const image = document.getElementById('modalImg');
                                cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 3,
                                });
                            }

                            document.getElementById('btnCrop').addEventListener('click', function() {
                                if (cropper) {
                                    var cropImgData = cropper.getCroppedCanvas({
                                        width: 400,
                                        height: 400
                                    });

                                    cropImgData.toBlob(function(blob) {
                                        var reader = new FileReader();
                                        reader.readAsDataURL(blob);

                                        reader.onloadend = function() {
                                            var base64data = reader.result;
                                            document.getElementById('profileImage').src = base64data;
                                            document.getElementById('croppedImageData').value = base64data;
                                        };
                                    });

                                    $('#modal-default').modal('hide');
                                }
                            });

                            $('#modal-default').on('hidden.bs.modal', function() {
                                if (cropper) {
                                    cropper.destroy();
                                    cropper = null;
                                }
                            });
                        </script>



                        <p class="text-bold text-red"><i>Student Information *</i></p>
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
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control form-control-sm" name="address" id="address" required>
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control form-control-sm" name="cellnum" id="cellnum" required>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control form-control-sm" name="email" id="email" required>
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
                                $type = $conn->query("SELECT * FROM role WHERE role_name = 'student' or 'students' ORDER BY id ASC");
                                while ($row = $type->fetch_assoc()) :
                                ?>
                                    <input type="hidden" name="role_id" value="<?= $row['id'] ?>">
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
                                <input type="hidden" name="dept_id" id="dept_id">
                                <input class="form-control form-control-sm" type="text" name="dept_name_display" id="dept_name" readonly>
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
                            <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Cancel</button>
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

                $('#dept_id').val(result.dept_id);
                $('#dept_name').val(result.dept_name);

            }
        });
    });


    $('#register').submit(function(e) {
        e.preventDefault()

        //regex validation
        if (!validateForm(this)) {
            return;
        }

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
                        location.href = 'index.php?page=student_data';
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 3) {
                    alert_toast("RFID already rigestered to someone", 'danger')

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>