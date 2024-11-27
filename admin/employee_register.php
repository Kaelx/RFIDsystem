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
                <div class="card-header text-bold text-center">Register Employee</div>
                <div class="card-body">
                    <form action="#" id="register">
                        <input type="hidden" name="id">

                        <div class="form-group text-right mb-0 mr-5">
                            <div style="position: relative; display: inline-block;">
                                <img class="img-bordered" src="assets/img/<?php echo (isset($data['img_path']) && file_exists('assets/img/' . $data['img_path'])) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <input type="hidden" id="croppedImageData" name="croppedImageData">
                            </div>
                        </div>

                        <div class="modal fade" id="modal-default" data-backdrop="static">
                            <div class="modal-dialog modal-lg">
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
                                            <img id="modalImg" src="assets/img/<?php echo (isset($data['img_path']) && file_exists('assets/img/' . $data['img_path'])) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Image Preview" class="img-fluid" style="max-height: 450px;" />
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <!-- Crop & Save and Cancel buttons -->
                                        <div>
                                            <button type="button" class="btn btn-primary" id="btnCrop">Crop & Save</button>
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
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
                                    dragMode: 'move',
                                    aspectRatio: 1,
                                    viewMode: 1,
                                });
                            }

                            document.getElementById('btnCrop').addEventListener('click', function() {
                                if (cropper) { // Check if cropper is defined
                                    var cropImgData = cropper.getCroppedCanvas({
                                        width: 600,
                                        height: 600
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


                        <p class="text-bold text-red"><i>Employee Information *</i></p>
                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control " name="fname" id="fname" autofocus>
                            </div>
                            <div class="col-md-1 form-group">
                                <label for="mname">M. I.</label>
                                <input type="text" class="form-control" name="mname" id="mname" oninput="this.value = this.value.slice(0, 1).toUpperCase()">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control " name="lname" id="lname">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="sname">Suffix</label>
                                <input type="text" class="form-control " name="sname" id="sname">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control " name="bdate" id="bdate">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control " name="gender" id="gender">
                                    <option value="" selected disabled>-- Select --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>

                        </div>


                        <hr>


                        <?php

                        $type = $conn->query("SELECT * FROM role WHERE id = 1 ORDER BY id ASC");
                        while ($row = $type->fetch_assoc()) :
                        ?>
                            <input type="hidden" name="role_id" value="<?= $row['id'] ?>">
                        <?php endwhile; ?>

                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control " name="school_id" id="school_id">
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="type_id">Position</label>
                                <select class="form-control select2" name="type_id" id="type_id">
                                    <option value="" selected disabled>-- Select --</option>
                                    <?php
                                    $type = $conn->query("SELECT * FROM employee_type  ORDER BY id ASC");
                                    while ($row = $type->fetch_assoc()) :
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['employee_type'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="dept_id">Department</label>
                                <select class="form-control select2" name="dept_id" id="dept_id">
                                    <option value="" selected>-- Select --</option>
                                    <?php
                                    $dept = $conn->query("SELECT * FROM department  ORDER BY id ASC");
                                    while ($row = $dept->fetch_assoc()) :
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['dept_name'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                                <small class="text-danger">leave blank if not applicable*</small>
                            </div>

                        </div>




                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="rfid">RFID</label>
                                <input type="password" class="form-control " name="rfid" id="rfid" placeholder="Click here then SCAN!">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Save</button>
                            <a href="index.php?page=employee_data" class="btn btn-danger btn-custom">Cancel</a>
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

        //regex validation
        if (!validateForm(this)) {
            return;
        }

        // Validate the form before AJAX submission
        if (!$(this).valid()) {
            return;
        }

        start_load();
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
                    }, 1000)

                } else if (resp == 3) {
                    alert_toast("RFID already registered to someone", 'danger')
                    setTimeout(function() {
                        end_load();
                    }, 1000)

                    $('#rfid').val('');

                } else if (resp == 4) {
                    alert_toast("Email already taken", 'danger')
                    setTimeout(function() {
                        end_load();
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                    setTimeout(function() {
                        end_load();
                    }, 1000)
                }
            }
        })
    })


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