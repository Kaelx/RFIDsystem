<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT m.*, d.dept_name, p.prog_name, c.cat_name FROM member m JOIN department d ON m.dept_id = d.id JOIN program p ON m.prog_id = p.id JOIN category c ON m.type_id = c.id where m.id = $uid ORDER BY m.id ASC");
    $member = mysqli_fetch_assoc($query);
} else {
    header('location: index.php?page=data');
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Data</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">


            <form action="#" id="register">
                <input type="hidden" name="id" value="<?= isset($member['id']) ? $member['id'] : '' ?>">
                <div class="form-group">
                    <label for="img">Profile Picture</label><br>
                    <input type="file" name="img" id="img">
                </div>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="fname">First Name</label>
                        <input type="text" class="form-control" name="fname" id="fname" required value="<?= isset($member['fname']) ? $member['fname'] : '' ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" class="form-control" name="lname" id="lname" required value="<?= isset($member['lname']) ? $member['lname'] : '' ?>">
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="type_id">Type</label>
                        <select class="form-control" name="type_id" id="type_id" required>
                            <option value="<?= isset($member['type_id']) ? $member['type_id'] : '' ?>"> <?= isset($member['cat_name']) ? $member['cat_name'] : '' ?></option>
                            <?php
                            $type = $conn->query("SELECT * FROM category order by id asc ");
                            while ($row = $type->fetch_assoc()) :
                            ?>
                                <option value="<?= $row['id'] ?>"><?= $row['cat_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="studentid">Student/Employee ID</label>
                        <input type="text" class="form-control" name="studentid" id="studentid" required value="<?= isset($member['studentid']) ? $member['studentid'] : '' ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" autocomplete="email" required value="<?= isset($member['email']) ? $member['email'] : '' ?>">
                </div>

                <div class="row">
                    <div class="col-md-6 form-group">
                        <label for="dept_id">School Department</label>

                        <select class="form-control" name="dept_id" id="dept_id" required>
                            <option value="<?= isset($member['dept_id']) ? $member['dept_id'] : '' ?>"><?= isset($member['dept_name']) ? $member['dept_name'] : '' ?></option>
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
                        <select class="form-control" name="prog_id" id="prog_id" required>
                        <option value="<?= isset($member['prog_id']) ? $member['prog_id'] : '' ?>"><?= isset($member['prog_name']) ? $member['prog_name'] : '' ?></option>
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
                    <input type="text" class="form-control" name="rfid" id="rfid" required value="<?= isset($member['rfid']) ? $member['rfid'] : '' ?>">
                </div>

                <div class="text-right mr-5">
                    <button class="btn btn-primary">Save</button>
                    <a href="index.php?page=data" class="btn btn-secondary">Back</a>
                </div>
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
                console.log("Response: ", resp);
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.href = 'index.php?page=data'
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.href = 'index.php?page=data'
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>