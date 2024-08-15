<?php
if (isset($_GET['uid'])) {
    $uid = $_GET['uid'];

    $query = $conn->query("SELECT m.*, d.dept_name, p.prog_name, c.cat_name FROM member m JOIN department d ON m.dept_id = d.id JOIN program p ON m.prog_id = p.id JOIN category c ON m.type_id = c.id where m.id = $uid ORDER BY m.id ASC");

    if ($query) {
        $member = mysqli_fetch_assoc($query);
    } else {
        echo "Error fetching data: " . mysqli_error($conn);
    }
}else{
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
                        <input type="text" class="form-control" name="type_id" id="type_id" value="<?= isset($member['cat_name']) ? $member['cat_name'] : '' ?>">
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
                        <input type="text" class="form-control" name="dept_id" id="dept_id" value="<?= isset($member['dept_name']) ? $member['dept_name'] : '' ?>">
                    </div>
                    <div class="col-md-6 form-group">
                        <label for="prog_id">School Program</label>
                        <input type="text" class="form-control" name="prog_id" id="prog_id" value="<?= isset($member['prog_name']) ? $member['prog_name'] : '' ?>">
                    </div>
                </div>

                <div class="form-group">
                    <label for="rfid">RFID</label>
                    <input type="text" class="form-control" name="rfid" id="rfid" required value="<?= isset($member['rfid']) ? $member['rfid'] : '' ?>">
                </div>
            </form>



        </div>
    </section>

</div>