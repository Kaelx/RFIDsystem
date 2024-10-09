<?php
if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    header('Location: index.php?page=student_data');
}
$uid = $_GET['uid'];

$query = $conn->query("SELECT s.*, r.role_name, 'visitor' as type
    FROM visitors s
    LEFT JOIN role r ON s.role_id = r.id 
    WHERE s.id = $uid 
    ORDER BY s.id ASC");

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
                <div class="card-header text-bold text-center">Visitor Information</div>
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
                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">First Name</p>
                            <p type="text" class="form-control "><?= isset($data['fname']) ? $data['fname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Middle Name</p>
                            <p type="text" class="form-control "><?= isset($data['mname']) ? $data['mname'] : '' ?></p>
                        </div>

                        <div class="col-md-3 form-group mb-0">
                            <p class="mb-2 text-bold">Last Name</p>
                            <p type="text" class="form-control "><?= isset($data['lname']) ? $data['lname'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Gender</p>
                            <p type="text" class="form-control "><?= isset($data['gender']) ? ucfirst($data['gender']) : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group mb-0">
                            <p class="mb-2 text-bold">Address</p>
                            <p type="text" class="form-control "><?= isset($data['address']) ? $data['address'] : '' ?></p>
                        </div>
                        <div class="col-md-2 form-group mb-0">
                            <p class="mb-2 text-bold">Contact No.</p>
                            <p type="number" class="form-control "><?= isset($data['cellnum']) ? $data['cellnum'] : '' ?></p>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 form-group">
                            <label for="rfid">RFID</label>
                            <input type="password" class="form-control " name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-6 ">
                            <a href="index.php?page=records&uid=<?= $data['id'] ?>&type=<?= $data['type'] ?>" class="btn btn-info"><i class="fa-solid fa-clipboard"></i>  Records</a>
                        </div>
                        <div class="col-md-6 text-right">
                            <button class="btn btn-danger btn-custom unarchive_visitor" type="button" data-id="<?php echo $data['id'] ?>">Unarchive</button>
                            <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.unarchive_visitor').click(function() {

        _conf("Are you sure to unarchive this data?", "unarchive_visitor", [$(this).attr('data-id')])
    });

    function unarchive_visitor($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=unarchive_visitor',
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