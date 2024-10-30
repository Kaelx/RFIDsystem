<?php
if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    header('Location: index.php?page=student_data');
}
$uid = $_GET['uid'];

$query = $conn->query("SELECT e.*, r.role_name, et.employee_type, d.dept_name , 'employee' as type
    FROM employees e
    LEFT JOIN role r ON e.role_id = r.id
    LEFT JOIN department d ON e.dept_id = d.id
    LEFT JOIN employee_type et ON e.employee_type_id = et.id
    WHERE e.id = $uid 
    ORDER BY e.id ASC");

$data = mysqli_fetch_assoc($query);

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
            <div class="card">
                <div class="card-header text-bold text-center">Employee Information</div>
                <div class="card-body">
                    <div class="form-group text-right mb-0 mr-5">
                        <div style="position: relative; display: inline-block;">
                            <?php if (isset($data['img_path']) && !empty($data['img_path'])): ?>
                                <img src="<?= 'assets/img/' . $data['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                            <?php else: ?>
                                <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                            <?php endif; ?>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-8 form-group mb-0">
                            <p class="mb-2 text-bold">Name</p>
                            <p type="text" class="form-control "><?= $data['fname'] .
                                                                        (!empty($data['mname']) ? ' ' . $data['mname'] . '.' : '') .
                                                                        ' ' . $data['lname'] .
                                                                        (!empty($data['sname']) ? ' ' . $data['sname'] : '');
                                                                    ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Birthdate</p>
                            <p type="date" class="form-control ">
                                <?php
                                if (isset($data['bdate'])) {
                                    $date = new DateTime($data['bdate']);
                                    echo $date->format('F j, Y');
                                } else {
                                    echo '';
                                }
                                ?></p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Gender</p>
                            <p type="text" class="form-control "><?= isset($data['gender']) ? ucfirst($data['gender']) : '' ?></p>
                        </div>

                    </div>


                    <hr>


                    <div class="row">
                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">School ID</p>
                            <p class="form-control "><?= isset($data['school_id']) ? $data['school_id'] : '' ?></p>
                        </div>

                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Employee Type</p>
                            <p class="form-control "><?= isset($data['employee_type']) ? $data['employee_type'] : '' ?></p>
                        </div>
                        <div class="col-md-3 form-group mb-0">
                                <p class="mb-2 text-bold">Department</p>
                                <p class="form-control "><?= isset($data['dept_name']) ? $data['dept_name'] : '' ?></p>
                            </div>
                    </div>


                    <div class="row">
                        <div class="col-md-3 form-group">
                            <label for="rfid">RFID</label>
                            <input type="password" class="form-control " name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ">
                            <a href="index.php?page=records&uid=<?= $data['id'] ?>&type=<?= $data['type'] ?>" class="btn btn-info"><i class="fa-solid fa-clipboard"></i> Records</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-danger btn-custom unarchive_employee" type="button" data-id="<?php echo $data['id'] ?>">Unarchive</button>
                            <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.unarchive_employee').click(function() {

        _conf("Are you sure to unarchive this data?", "unarchive_employee", [$(this).attr('data-id')])
    });

    function unarchive_employee($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=unarchive_employee',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully unarchive", 'warning')
                    setTimeout(function() {
                        window.history.back();
                        return false;
                    }, 1000)

                }
            }
        })
    }
</script>