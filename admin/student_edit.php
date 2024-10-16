<?php

if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    exit();
}

$uid = $_GET['uid'];

$query = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name 
    FROM students s 
    LEFT JOIN department d ON s.dept_id = d.id 
    LEFT JOIN program p ON s.prog_id = p.id 
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

$data = mysqli_fetch_assoc($query);

?>


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


<!-- RFID Placeholder (initially hidden) -->
<div id="rfid_placeholder" class="d-none position-absolute"
    style="top: 0; left: 0; right: 0; bottom: 0; width: 100%; background-color: rgba(108, 117, 125, 0.5); z-index: 1000; display: flex; flex-direction: column; align-items: center; justify-content: center;">
    <i class="fa-solid fa-barcode" style="font-size: 200px;"></i>
    <span style="margin-top: 8px; font-size: 32px; font-weight:bold;">Scan RFID</span>
</div>


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



                        <div class="form-group text-right mb-0 mr-5">
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <input type="hidden" id="croppedImageData" name="croppedImageData">
                            </div>
                        </div>

                        <div class="modal fade" id="modal-default" data-backdrop="static">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body text-center">
                                        <!-- Button container, responsive with Bootstrap's d-flex and flex-column for mobile -->
                                        <div class="m-2 d-flex flex-wrap justify-content-center">
                                            <button type="button" id="uploadImg" class="btn btn-success m-1">Upload Image</button>
                                            <button type="button" id="useCamera" class="btn btn-info m-1">Use Camera</button>
                                        </div>

                                        <!-- File input container, responsive class for input -->
                                        <div id="fileInputDiv">
                                            <input type="file" name="img" id="img" accept="image/*" class="form-control mb-3" onchange="previewImage(event)" style="display: none;">
                                        </div>

                                        <!-- Camera section -->
                                        <div id="cameraDiv" class="mb-3" style="display: none;">
                                            <video id="cameraStream" autoplay class="img-fluid rounded mb-3 w-100"></video>
                                            <button type="button" class="btn btn-primary" id="captureImage">Capture Image</button>

                                            <hr>
                                            <canvas id="cameraCanvas" style="display: none;"></canvas>
                                        </div>

                                        <!-- Image preview -->
                                        <div class="img-fluid">
                                            <img id="modalImg" src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Image Preview" class="img-fluid" style="max-height: 450px;" />
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between flex-wrap">
                                        <!-- Reset Button -->
                                        <div class="mb-2 mb-md-0">
                                            <button type="button" class="btn btn-danger" id="cropReset">Reset</button>
                                        </div>
                                        <!-- Crop & Save and Cancel buttons -->
                                        <div class="d-flex flex-column flex-md-row">
                                            <button type="button" class="btn btn-primary mr-2" id="btnCrop">Crop & Save</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <script>
                            let cropper;
                            let currentStream;

                            document.getElementById('useCamera').addEventListener('click', function() {
                                document.getElementById('fileInputDiv').style.display = 'none';
                                document.getElementById('cameraDiv').style.display = 'block';
                                startCamera();
                            });

                            // Start camera stream
                            function startCamera() {
                                navigator.mediaDevices.getUserMedia({
                                        video: true
                                    })
                                    .then(function(stream) {
                                        currentStream = stream; // Store the current stream
                                        document.getElementById('cameraStream').srcObject = stream;
                                    })
                                    .catch(function(err) {
                                        console.error("Error accessing camera: ", err);
                                        alert("Unable to access camera. Please check permissions.");
                                    });
                            }

                            // Stop the camera stream
                            function stopCamera() {
                                if (currentStream) {
                                    let tracks = currentStream.getTracks();
                                    tracks.forEach(track => track.stop());
                                    currentStream = null; // Clear the stream
                                }
                                document.getElementById('cameraDiv').style.display = 'none'; // Hide the camera view
                            }

                            // Capture image from camera
                            document.getElementById('captureImage').addEventListener('click', function() {
                                var video = document.getElementById('cameraStream');
                                var canvas = document.getElementById('cameraCanvas');
                                canvas.width = video.videoWidth;
                                canvas.height = video.videoHeight;
                                canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);

                                // Convert the captured image to a data URL and display it
                                var dataUrl = canvas.toDataURL('image/png');
                                document.getElementById('modalImg').src = dataUrl;

                                // Stop the video stream
                                stopCamera(); // Use the stop function

                                // Initialize cropper after setting the image
                                initializeCropper();
                            });

                            function previewImage(event) {
                                var reader = new FileReader();
                                reader.onload = function() {
                                    var output = document.getElementById('modalImg');
                                    output.src = reader.result;
                                    initializeCropper();
                                };
                                reader.readAsDataURL(event.target.files[0]);
                                stopCamera(); // Ensure the camera is stopped if switching to file input
                            }

                            function initializeCropper() {
                                const image = document.getElementById('modalImg');
                                if (cropper) {
                                    cropper.destroy(); // Destroy the previous instance if it exists
                                }
                                cropper = new Cropper(image, {
                                    aspectRatio: 1,
                                    viewMode: 1,
                                });
                            }

                            document.getElementById('btnCrop').addEventListener('click', function() {
                                if (cropper) { // Check if cropper is defined
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
                                } else {
                                    console.error("Cropper is not initialized.");
                                }
                            });

                            $('#profileImage').on('click', function() {
                                $('#modal-default').modal('show');
                            });

                            $('#uploadImg').on('click', function() {
                                stopCamera(); // Stop the camera when switching to upload
                                $('#img').click();
                            });

                            $('#cropReset').on('click', function() {
                                if (cropper) {
                                    cropper.reset();
                                }
                            });

                            $('#modal-default').on('hidden.bs.modal', function() {
                                stopCamera(); // Stop the camera when modal is closed
                                if (cropper) {
                                    cropper.destroy();
                                    cropper = null;
                                }
                            });
                        </script>








                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control " name="fname" id="fname" required value="<?= isset($data['fname']) ? $data['fname'] : '' ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="mname">Middle Name</label>
                                <input type="text" class="form-control " name="mname" id="mname" required value="<?= isset($data['mname']) ? $data['mname'] : '' ?>">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control " name="lname" id="lname" required value="<?= isset($data['lname']) ? $data['lname'] : '' ?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control " name="bdate" id="bdate" required value="<?= isset($data['bdate']) ? $data['bdate'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control " name="gender" id="gender" required>
                                    <option value="" disabled <?= empty($data['gender']) ? 'selected' : '' ?>>-- Select --</option>
                                    <option value="male" <?= ($data['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?= ($data['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="address">Address</label>
                                <input type="text" class="form-control " name="address" id="address" required value="<?= isset($data['address']) ? $data['address'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="cellnum">Contact No.</label>
                                <input type="number" class="form-control " name="cellnum" id="cellnum" required value="<?= isset($data['cellnum']) ? $data['cellnum'] : '' ?>" required oninput="this.value = this.value.slice(0, 11);" pattern="\d{11}" title="Please enter exactly 11 digits">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control " name="email" id="email" required value="<?= isset($data['email']) ? $data['email'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="parent_name">Complete Name of Parent/Guardian</label>
                                <input type="text" class="form-control " name="parent_name" id="parent_name" required value="<?= isset($data['parent_name']) ? $data['parent_name'] : '' ?>">
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="parent_num">Contact No. of Parent/Guardian</label>
                                <input type="number" class="form-control " name="parent_num" id="parent_num" required value="<?= isset($data['parent_num']) ? $data['parent_num'] : '' ?>" required oninput="this.value = this.value.slice(0, 11);" pattern="\d{11}" title="Please enter exactly 11 digits">
                            </div>
                        </div>


                        <div class="row">

                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control " name="school_id" id="school_id" required value="<?= isset($data['school_id']) ? $data['school_id'] : '' ?>">
                            </div>


                            <div class="col-md-4 form-group">
                                <label for="prog_id">Program/Course</label>
                                <select class="form-control  select2" name="prog_id" id="prog_id" required>
                                    <option value="" <?= !isset($data['prog_id']) || $data['prog_id'] == '' ? 'selected' : '' ?> disabled></option>
                                    <?php
                                    $type = $conn->query("SELECT * FROM program ORDER BY id ASC");
                                    while ($row = $type->fetch_assoc()) :
                                        $selected = isset($data['prog_id']) && $data['prog_id'] == $row['id'] ? 'selected' : '';
                                    ?>
                                        <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['prog_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <input type="hidden" class="form-control " name="dept_id" id="dept_id" required value="<?= isset($data['dept_id']) ? $data['dept_id'] : '' ?>">
                        </div>

                        <div class="row">

                            <?php
                            $type = $conn->query("SELECT * FROM role WHERE id = 2 ORDER BY id ASC");
                            while ($row = $type->fetch_assoc()) :
                            ?>
                                <input type="hidden" name="role_id" value="<?= $row['id'] ?>">
                            <?php endwhile; ?>

                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control " name="rfid" id="rfid" required value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-custom">Save</button>
                                <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Cancel</button>
                            </div>
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

        //regex validation
        if (!validateForm(this)) {
            return;
        }

        start_load();
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

                } else if (resp == 3) {
                    alert_toast("RFID already rigestered to someone", 'danger')
                    setTimeout(function() {
                        location.reload();
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    });

    $('.select2').select2();
    $('.select2').on('select2:open', function() {
        let searchField = document.querySelector('.select2-container--open .select2-search__field');

        searchField.placeholder = 'Search Course/Program';
        searchField.focus();
    });


    $('#rfid').on('focus', function() {
        $(this).val('');
        $('.content-wrapper').css('filter', 'blur(8px)');
        $('#rfid_placeholder').removeClass('d-none');
    });

    $('#rfid').on('blur', function() {
        $('.content-wrapper').css('filter', 'none');
        $('#rfid_placeholder').addClass('d-none');
    });
</script>