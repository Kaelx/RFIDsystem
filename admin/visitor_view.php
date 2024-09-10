<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT s.*, d.dept_name, p.prog_name, r.role_name 
    FROM students s 
    LEFT JOIN department d ON s.dept_id = d.id 
    LEFT JOIN program p ON s.prog_id = p.id 
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

    $member = mysqli_fetch_assoc($query);
} else {
    header('location: index.php?page=visitor_data');
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
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
                        <label for="role_id">Role</label>
                        <select class="form-control" name="role_id" id="role_id" required>
                            <option value="" <?= !isset($member['role_id']) || $member['role_id'] == '' ? 'selected' : '' ?> disabled>-- Select Role --</option>
                            <?php
                            $type = $conn->query("SELECT * FROM role ORDER BY id ASC");
                            while ($row = $type->fetch_assoc()) :
                                $selected = isset($member['role_id']) && $member['role_id'] == $row['id'] ? 'selected' : '';
                            ?>
                                <option value="<?= $row['id'] ?>" <?= $selected ?>><?= $row['role_name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required value="<?= isset($member['email']) ? $member['email'] : '' ?>">
                </div>

                <div class="form-group">
                    <label for="rfid">RFID</label>
                    <input type="password" class="form-control" name="rfid" id="rfid" required value="<?= isset($member['rfid']) ? $member['rfid'] : '' ?>">
                </div>

                <div class="text-right mr-5">
                    <button class="btn btn-primary">Save</button>
                    <a href="index.php?page=visitor_data" class="btn btn-secondary">Back</a>
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

                console.log("Response: ", resp); //to see the error


                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.href = 'index.php?page=visitor_data'
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.href = 'index.php?page=visitor_data'
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })
</script>