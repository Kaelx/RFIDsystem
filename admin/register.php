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
                <input type="hidden" name="id">
                <div class="form-group">
                    <label for="img">Image</label>
                    <input type="file" class="form-control" name="img" id="img">
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fname" >First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="type_id">Type</label>
                        <select class="form-control" name="type_id" id="type_id" required>
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
                        <label for="studentid">Student/Employee ID</label>
                        <input type="text" class="form-control" name="studentid" id="studentid" required>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" autocomplete="email" required>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="dept_id">School Department</label>
                        <select class="form-control" name="dept_id" id="dept_id" required>
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
                        <select class="form-control"  name="prog_id" id="prog_id" required>
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
                    <input type="text" class="form-control" name="rfid" id="rfid" required>
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
			url: 'ajax.php?action=register',
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
					alert_toast("Data successfully updated", 'success')
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