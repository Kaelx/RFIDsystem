<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
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
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" id="fname" name="fname" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" id="lname" name="lname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="type_id">Type</label>
                        <select name="type_id" id="type_id" class="form-control" required>
                            <option value="" selected disabled>-- Select Role --</option>
                            <?php
                            $type = $conn->query("SELECT * FROM category order by id asc ");
                            while ($row = $type->fetch_assoc()) :
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['cat_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="studentid">Student ID</label>
                        <input type="text" class="form-control" name="studentid" id="studentid" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" autocomplete="email" required>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="dept_id">School Department</label>
                        <select name="dept_id"  id="dept_id" class="form-control" required>
                            <option value="" selected disabled>-- Select Department --</option>
                            <?php
                            $department = $conn->query("SELECT * FROM department order by id asc ");
                            while ($row = $department->fetch_assoc()) :
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['dept_name'] ?></option>

                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="prog_id">School Program</label>
                        <select name="prog_id"  id="prog_id"  class="form-control" required>
                            <option value="" selected disabled>-- Select Program --</option>
                            <?php
                            $program = $conn->query("SELECT * FROM program order by id asc ");
                            while ($row = $program->fetch_assoc()) :
                            ?>
                                <option value="<?php echo $row['id'] ?>"><?php echo $row['prog_name'] ?></option>

                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="rfid">RFID</label>
                    <input type="text" class="form-control" id="rfid" name="rfid" required>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
                <a href="index.php?page=data" class="btn btn-secondary">Cancel</a>
            </form>


        </div>
    </section>

</div>
<script>
    $('#register').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=save_register',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }else{
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>