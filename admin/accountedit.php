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
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <form action="#" id="register">
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="img">Profile Picture</label><br>
                    <input type="file" name="img" id="img">
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" value="<?= $member['fname'] ?>" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" value="<?= $member['lname'] ?>" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="account_type">Type</label>
                        <select class="form-control" name="account_type" id="account_type" required>
                            <option value="0" <?= $member['account_type'] == 0 ? 'selected' : '' ?>>Admin</option>
                            <option value="1" <?= $member['account_type'] == 1 ? 'selected' : '' ?>>Staff</option>
                            <option value="2" <?= $member['account_type'] == 2 ? 'selected' : '' ?>>Security Personnel</option>
                        </select>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" value="<?= $member['email'] ?>" required>
                    </div>
                    <div class="col-md-6 form-group">

                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" id="password">
                        <small class="m-2 text-danger font-italic">*Leave blank if you don't want to change password.</small>
                    </div>
                </div>

                <div class="text-right mr-5">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=accountmanage" class="btn btn-secondary">Cancel</a>
                </div>
            </form>


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
</script>