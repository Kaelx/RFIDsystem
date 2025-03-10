<?php
$uid = $_SESSION['login_id'];

$query = $conn->query("SELECT * from users where id = $uid");

$member = mysqli_fetch_assoc($query);

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


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Profile Settings</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-lg">
                <div class="card-header text-bold text-center">User Profile</div>


                <div class="card-body">
                    <form action="#" id="profile_update">
                        <input type="hidden" name="id" value="<?= isset($member['id']) ? $member['id'] : '' ?>">
                        <input type="hidden" name="account_type" value="<?= isset($member['account_type']) ? $member['account_type'] : '' ?>">


                        <div class="form-group text-center text-md-right mb-0 mr-md-5">
                            <div style="position: relative; display: inline-block;">
                                <img class="img-bordered" src="./assets/img/<?php echo isset($member['img_path']) && file_exists('assets/img/' . $member['img_path']) ? $member['img_path'] : 'blank-img.png'; ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
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
                                            <img id="modalImg" src="assets/img/<?php echo isset($member['img_path']) && file_exists('assets/img/' . $member['img_path']) ? $member['img_path'] : 'blank-img.png'; ?>" alt="Image Preview" class="img-fluid" style="max-height: 450px;" />
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


                        <div class="row">
                            <div class="col-md-3 form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control " name="fname" id="fname" value="<?= isset($member['fname']) ? $member['fname'] : '' ?>">
                            </div>

                            <div class="col-md-1 form-group">
                                <label for="mname">M. I.</label>
                                <input type="text" class="form-control " name="mname" id="mname" value="<?= isset($member['mname']) ? $member['mname'] : '' ?>" oninput="this.value = this.value.slice(0, 1).toUpperCase()">
                            </div>
                            <div class="col-md-3 form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control " name="lname" id="lname" value="<?= isset($member['lname']) ? $member['lname'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="sname">Suffix</label>
                                <input type="text" class="form-control " name="sname" id="sname" value="<?= isset($member['sname']) ? $member['sname'] : '' ?>">
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-2 form-group">
                                <label for="bdate">Birthdate</label>
                                <input type="date" class="form-control " name="bdate" id="bdate" value="<?= isset($member['bdate']) ? $member['bdate'] : '' ?>">
                            </div>
                            <div class="col-md-2 form-group">
                                <label for="gender">Gender</label>
                                <select class="form-control " name="gender" id="gender">
                                    <option value="" disabled <?= empty($member['gender']) ? 'selected' : '' ?>>-- Select --</option>
                                    <option value="male" <?= isset($member['gender']) && $member['gender'] == 'male' ? 'selected' : '' ?>>Male</option>
                                    <option value="female" <?= isset($member['gender']) && $member['gender'] == 'female' ? 'selected' : '' ?>>Female</option>
                                </select>
                            </div>

                            <div class="col-md-3 form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control " name="email" id="email" value="<?= isset($member['email']) ? $member['email'] : '' ?>">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="school_id">School ID</label>
                                <input type="text" class="form-control " name="school_id" id="school_id" value="<?= isset($member['school_id']) ? $member['school_id'] : '' ?>">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="username">username</label>
                                <input type="username" class="form-control " name="username" id="username" value="<?= isset($member['username']) ? $member['username'] : '' ?>">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control " name="password" id="password" minlength="8">
                                <small class="text-italic text-danger"><span>Leave blank to remain the same password*</span></small>
                            </div>
                            <div class="col-md-4 form-group">
                                <label for="confirmpass">Confirm Password</label>
                                <input type="password" class="form-control " name="confirmpass" id="confirmpass">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 text-right">
                                <button type="submit" class="btn btn-primary btn-custom">Save</button>
                                <button onclick="window.history.back(); return false;" class="btn btn-secondary btn-custom">Back</button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

</div>

<script>
    $('#profile_update').submit(function(e) {
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
                        location.reload()
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else if (resp == 3) {
                    alert_toast("Email already exist", 'danger')
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
</script>