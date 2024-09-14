<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Register</h1>
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
                    <div class="col-md-3 form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="mname">Middle Name</label>
                        <input type="text" class="form-control" name="mname" id="mname" required>
                    </div>
                    <div class="col-md-3 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 form-group">
                        <label for="account_type">Type</label>
                        <select class="form-control" name="account_type" id="account_type" required>
                            <option value="" selected disabled>-- Select Role --</option>
                            <option value="0">Admin</option>
                            <option value="1">Staff</option>
                            <option value="2">Security Personnel</option>
                        </select>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-4 form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="username">username</label>
                            <input type="username" class="form-control" name="username" id="username" required>
                        </div>
                        <div class="col-md-4 form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" required>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="index.php?page=accountmanage" class="btn btn-secondary">Cancel</a>
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

                }else if (resp == 3) {
                    alert_toast("Email already exist", 'info')

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>