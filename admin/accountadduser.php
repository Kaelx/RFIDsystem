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
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <div class="card">
                <div class="card-header text-bold text-center">Register User</div>
                <div class="card-body">
                    <form action="#" id="register">
                        <input type="hidden" name="id">




                        <div class="form-group text-right mb-0 mr-5">
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <input type="hidden" id="croppedImageData" name="croppedImageData">
                            </div>
                        </div>

                        <div class="modal fade" id="modal-default" data-backdrop="static">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Choose Image</h5>
                                    </div>
                                    <div class="modal-body text-center">
                                        <div class="m-2">
                                            <button type="button" id="uploadImg" class="btn btn-success">Upload Image</button>
                                            <button type="button" id="useCamera" class="btn btn-info">Use Camera</button>
                                        </div>

                                        <div id="fileInputDiv">
                                            <input type="file" name="img" id="img" accept="image/*" class="form-control mb-3" onchange="previewImage(event)" style="display: none;">
                                        </div>

                                        <div id="cameraDiv" style="display: none;">
                                            <video id="cameraStream" autoplay class="img-fluid rounded mb-3"></video>
                                            <button type="button" class="btn btn-primary" id="captureImage">Capture Image</button>

                                            <hr>
                                            <canvas id="cameraCanvas" style="display: none;"></canvas>
                                        </div>
                                        <div class="img-fluid">
                                            <img id="modalImg" src="assets/img/<?php echo isset($data['img_path']) ? $data['img_path'] : 'blank-img.png'; ?>" alt="Image Preview" class="img-fluid rounded" />
                                        </div>
                                    </div>
                                    <div class="modal-footer d-flex justify-content-between">
                                        <div>
                                            <button type="button" class="btn btn-danger" id="cropReset">Reset</button>
                                        </div>
                                        <div>
                                            <button type="button" class="btn btn-primary" id="btnCrop">Crop & Save</button>
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
                                    viewMode: 3,
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
                                    <option value="" selected disabled>-- Select --</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
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

                        <hr>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control form-control-sm" name="school_id" id="school_id" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="account_type">Type</label>
                                <select class="form-control form-control-sm" name="account_type" id="account_type" required>
                                    <option value="" selected disabled>-- Select --</option>
                                    <option value="1">Admin</option>
                                    <option value="2">Staff</option>
                                    <option value="3">Security Personnel</option>
                                </select>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="username">username</label>
                                <input type="username" class="form-control form-control-sm" name="username" id="username" required>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control form-control-sm" name="password" id="password" required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-custom">Save</button>
                            <buttom onclick="window.history.back(); return false;" class="btn btn-secondary btn-custom">Cancel</buttom>
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
            url: 'ajax.php?action=adduser',
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
                        location.href = 'index.php?page=accountmanage'
                    }, 1200)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.href = 'index.php?page=accountmanage'
                    }, 1200)

                } else if (resp == 3) {
                    alert_toast("Email already exist", 'info')

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>