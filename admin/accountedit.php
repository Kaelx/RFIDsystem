<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT * from users where id = $uid");

    $member = mysqli_fetch_assoc($query);
} else {
    header('location: index.php?page=home');
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


            <section class="content">
                <div class="container-fluid">
                    <div class="card">
                        <div class="card-header text-bold text-center">Employee Information</div>
                        <div class="card-body">
                            <form action="#" id="register">
                                <input type="hidden" name="id" value="<?= isset($member['id']) ? $member['id'] : '' ?>">


                                <div class="form-group text-right mb-0 mr-5">
                                    <div style="position: relative; display: inline-block;">
                                        <?php if (isset($member['img_path']) && !empty($member['img_path'])): ?>
                                            <img src="<?= 'assets/img/' . $member['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
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
                                        <input type="text" class="form-control form-control-sm" name="fname" id="fname" required value="<?= isset($member['fname']) ? $member['fname'] : '' ?>">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="mname">Middle Name</label>
                                        <input type="text" class="form-control form-control-sm" name="mname" id="mname" required value="<?= isset($member['mname']) ? $member['mname'] : '' ?>">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control form-control-sm" name="lname" id="lname" required value="<?= isset($member['lname']) ? $member['lname'] : '' ?>">
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-2 form-group">
                                        <label for="bdate">Birthdate</label>
                                        <input type="date" class="form-control form-control-sm" name="bdate" id="bdate" required value="<?= isset($member['bdate']) ? $member['bdate'] : '' ?>">
                                    </div>
                                    <div class="col-md-2 form-group">
                                        <label for="gender">Gender</label>
                                        <select class="form-control form-control-sm" name="gender" id="gender" required>
                                            <option value="" disabled>-- Select Role --</option>
                                            <option value="male" <?= ($member['gender'] == 'male') ? 'selected' : '' ?>>Male</option>
                                            <option value="female" <?= ($member['gender'] == 'female') ? 'selected' : '' ?>>Female</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3 form-group">
                                        <label for="address">Address</label>
                                        <input type="text" class="form-control form-control-sm" name="address" id="address" required value="<?= isset($member['address']) ? $member['address'] : '' ?>">
                                    </div>
                                    <div class="col-md-3 form-group">
                                        <label for="cellnum">Contact No.</label>
                                        <input type="number" class="form-control form-control-sm" name="cellnum" id="cellnum" required value="<?= isset($member['cellnum']) ? $member['cellnum'] : '' ?>">
                                    </div>

                                    <div class="col-md-3 form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control form-control-sm" name="email" id="email" required value="<?= isset($member['email']) ? $member['email'] : '' ?>">
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="school_id">School ID</label>
                                        <input type="text" class="form-control form-control-sm" name="school_id" id="school_id" required value="<?= isset($member['school_id']) ? $member['school_id'] : '' ?>">
                                    </div>






                                    <div class="col-md-4 form-group">
                                        <label for="account_type">Type</label>
                                        <select class="form-control form-control-sm" name="account_type" id="account_type" required>
                                            <option value="" disabled <?= !isset($member['account_type']) ? 'selected' : '' ?>>-- Select Role --</option>
                                            <option value="1" <?= isset($member['account_type']) && $member['account_type'] == '1' ? 'selected' : '' ?>>Admin</option>
                                            <option value="2" <?= isset($member['account_type']) && $member['account_type'] == '2' ? 'selected' : '' ?>>Staff</option>
                                            <option value="3" <?= isset($member['account_type']) && $member['account_type'] == '3' ? 'selected' : '' ?>>Security Personnel</option>
                                        </select>
                                    </div>


                                </div>

                                <div class="row">
                                    <div class="col-md-4 form-group">
                                        <label for="username">username</label>
                                        <input type="username" class="form-control form-control-sm" name="username" id="username" value="<?= isset($member['username']) ? $member['username'] : '' ?>" required>
                                    </div>
                                    <div class="col-md-4 form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control form-control-sm" name="password" id="password">
                                        <small class="text-italic text-danger">*Leave blank if don't want to change password.</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary btn-custom">Save</button>
                                        <button onclick="window.history.back(); return false;" class="btn btn-secondary btn-custom">Cancel</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </section>


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
                        location.reload()
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
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