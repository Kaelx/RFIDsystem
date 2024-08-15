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
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="fname" required>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="lname" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>Type</label>
                        <select name="type_id" class="form-control" required>
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
                        <label>Student ID</label>
                        <input type="text" class="form-control" name="studentid" required>
                    </div>
                </div>

                <div class="form-group">
                    <label >Email</label>
                    <input type="email" class="form-control" name="email" autocomplete="email" required>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>School Department</label>
                        <select name="dept_id" class="form-control" required>
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
                        <label>School Program</label>
                        <select name="prog_id" class="form-control" required>
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
                    <label>RFID</label>
                    <input type="text" class="form-control" name="rfid" required>
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