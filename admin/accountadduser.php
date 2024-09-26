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



                        <div class="form-group text-right m-2">
                            <label for="img" class="mr-4">Upload Picture</label><br>
                            <div style="position: relative; display: inline-block;">
                                <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                <!-- Hidden File Input -->
                                <input type="file" name="img" id="img" style="display: none;" onchange="previewImage(event)">
                            </div>
                        </div>

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
                                    <option value="" selected disabled>-- Select Role --</option>
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