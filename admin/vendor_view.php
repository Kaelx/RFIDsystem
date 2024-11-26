<?php
if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    exit();
}
$uid = $_GET['uid'];

$query = $conn->query("SELECT cv.*, r.role_name, 'vendor' as type
    FROM vendors cv 
    LEFT JOIN role r ON cv.role_id = r.id 
    WHERE cv.id = $uid 
    ORDER BY cv.id ASC");

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
                <div class="card-header text-bold text-center">Vendor Information</div>
                <div class="card-body">
                    <div class="form-group text-right mb-0 mr-5">
                        <div style="position: relative; display: inline-block;">
                            <?php if (isset($data['img_path']) && !empty($data['img_path'])): ?>
                                <img class="img-bordered" src="<?= 'assets/img/' . $data['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                            <?php else: ?>
                                <img class="img-bordered" src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
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
                        <div class="col-md-3 form-group">
                            <label for="rfid">RFID</label>
                            <input type="password" class="form-control " name="rfid" id="rfid" value="<?= isset($data['rfid']) ? $data['rfid'] : '' ?>" readonly>
                        </div>
                    </div>

                    <div>
                        <div class="row">
                            <!-- Left Column (Record Button) -->
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start mb-2 mb-md-0">
                                <a href="index.php?page=records&uid=<?= $data['id'] ?>&type=<?= $data['type'] ?>"
                                    class="btn btn-info">
                                    <i class="fa-solid fa-clipboard"></i> Record
                                </a>
                            </div>

                            <!-- Right Column (Edit, Archive, and Back Buttons) -->
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end">
                                <a href="index.php?page=vendor_edit&uid=<?= $data['id'] ?>"
                                    class="btn btn-primary btn-custom mb-2 mb-md-0 mx-1">
                                    Edit
                                </a>
                                <button class="btn btn-danger btn-custom archive_vendor mb-2 mb-md-0 mx-1"
                                    type="button" data-id="<?= $data['id'] ?>">
                                    Archive
                                </button>
                                <a href="index.php?page=vendor_data"
                                    class="btn btn-secondary btn-custom mb-2 mb-md-0 mx-1">
                                    Back
                                </a>
                            </div>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </section>


</div>

<script>
    $('.archive_vendor').click(function() {

        _conf("Are you sure to archivev this data?", "archive_vendor", [$(this).attr('data-id')])
    });

    function archive_vendor($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=archive_vendor',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully archive", 'warning')
                    setTimeout(function() {
                        location.href = 'index.php?page=vendor_data'
                    }, 1000)

                }
            }
        })
    }
</script>