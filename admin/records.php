<?php

if (!isset($_GET['uid']) || empty($_GET['uid'])) {
    header('Location: index');
}

$uid = $_GET['uid'];
$type = $_GET['type'];

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';



?>





<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <?php
                    switch ($type) {
                        case 'students':
                            $query = "SELECT s.id, s.fname, s.mname, s.lname, s.school_id, r.role_name, s.rfid, s.img_path, s.gender
            FROM students s
            LEFT JOIN role r ON s.role_id = r.id
            WHERE s.id = '$uid'
        ";
                            break;

                        case 'employees':
                            $query = "SELECT e.id, e.fname, e.mname, e.lname, e.school_id, r.role_name, e.rfid, e.img_path, e.gender
            FROM employees e
            LEFT JOIN role r ON e.role_id = r.id
            WHERE e.id = '$uid'
        ";
                            break;

                        case 'visitors':
                            $query = "SELECT v.id, v.fname, v.mname, v.lname, NULL as school_id, r.role_name, v.rfid, v.img_path, v.gender
            FROM visitors v
            LEFT JOIN role r ON v.role_id = r.id
            WHERE v.id = '$uid'
        ";
                            break;

                        default:
                            die('Invalid type');
                    }

                    $result = $conn->query($query);
                    $member = $result->fetch_assoc();

                    ?>

                    <div class="col-md-7">
                        <div class="card">
                            <div class="card-body">
                                <!-- profile -->
                                <div class="row">
                                    <div style="position: relative; display: inline-block;">
                                        <?php if (isset($member['img_path']) && !empty($member['img_path'])): ?>
                                            <img src="<?= 'assets/img/' . $member['img_path'] ?>" alt="Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                        <?php else: ?>
                                            <img src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage" width="150" height="150" style="cursor: pointer; border-radius: 50%;">
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="form-control form-control-sm"><?= $member['fname'] . ' ' . $member['mname'] . ' ' . $member['lname'] ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <p class="form-control form-control-sm"><?= isset($member['gender']) ? ucfirst($member['gender']) : 'Gender not set' ?></p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <p class="form-control form-control-sm"><?= $member['role_name'] ?></p>
                                            </div>
                                            <?php if (trim(strtolower($member['role_name'])) != 'visitor') { ?>
                                                <div class="col-md-6">
                                                    <p class="form-control form-control-sm"><?= $member['school_id'] ?></p>
                                                </div>
                                            <?php } ?>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <form action="#" id="filter-report" class="form-inline d-flex align-items-center">
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="start_date" class="mr-2">Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control" value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                        </div>
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="end_date" class="mr-2">To </label>
                            <input type="date" name="end_date" id="end_date" class="form-control" value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>

                        <div class="dropdown mb-2">
                            <button id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Filter</button>
                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                <li><a href="#" class="dropdown-item" onclick="filterBy('day')">This Day</a></li>
                                <li><a href="#" class="dropdown-item" onclick="filterBy('week')">This Week</a></li>
                                <li><a href="#" class="dropdown-item" onclick="filterBy('month')">This Month</a></li>
                            </ul>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Time in</th>
                                    <th class="text-center">Time out</th>
                                    <th class="text-center">Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $query = "SELECT r.timein, r.timeout,
                                        COALESCE(s.fname, e.fname, v.fname) AS fname, 
                                        COALESCE(s.mname, e.mname, v.mname) AS mname, 
                                        COALESCE(s.lname, e.lname, v.lname) AS lname,
                                        COALESCE(s.school_id, e.school_id, NULL) AS school_id,
                                        COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name
                                    FROM records r
                                    LEFT JOIN students s ON r.recordable_id = s.id AND r.recordable_table = 'students'
                                    LEFT JOIN employees e ON r.recordable_id = e.id AND r.recordable_table = 'employees'
                                    LEFT JOIN visitors v ON r.recordable_id = v.id AND r.recordable_table = 'visitors'
                                    LEFT JOIN role r_s ON s.role_id = r_s.id
                                    LEFT JOIN role r_e ON e.role_id = r_e.id
                                    LEFT JOIN role r_v ON v.role_id = r_v.id
                                    WHERE r.recordable_id = '$uid' and r.recordable_table = '$type'
                                ";



                                if (!empty($start_date) && !empty($end_date)) {
                                    $query .= " AND DATE(r.timein) BETWEEN '$start_date' AND '$end_date'
                                                        AND DATE(r.timeout) BETWEEN '$start_date' AND '$end_date'";
                                }

                                $result = $conn->query($query);

                                $i = 1;
                                while ($row = $result->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?= $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td class=" text-center"><?php echo $row['timein']; ?></td>
                                        <td class="text-center"><?php echo !empty($row['timeout']) ? $row['timeout'] : '------'; ?></td>
                                        <td class="text-center">
                                            <?php
                                            if (!empty($row['timein']) && !empty($row['timeout'])) {
                                                $timein = strtotime($row['timein']);
                                                $timeout = strtotime($row['timeout']);

                                                $duration_in_seconds = $timeout - $timein;

                                                $hours = floor($duration_in_seconds / 3600);
                                                $minutes = floor(($duration_in_seconds % 3600) / 60);

                                                echo $hours . ' hours, ' . $minutes . ' minutes';
                                            } else {
                                                echo ' ------ ';
                                            }
                                            ?>
                                        </td>


                                    </tr>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
    $('table').DataTable({
        ordering: false,
        searching: false,
        lengthChange: false,
        stateSave: true
    });



    $('#filter-report').submit(function(e) {
        e.preventDefault();

        var uid = "<?php echo $uid; ?>";
        var type = "<?php echo $type; ?>";
        let startDate, endDate;


        location.href = `index.php?page=records&uid=${encodeURIComponent(uid)}&type=${encodeURIComponent(type)}&` + $(this).serialize();
    });


    function filterBy(period) {

        var uid = "<?php echo $uid; ?>";
        var type = "<?php echo $type; ?>";
        const formatDate = date => date.toISOString().split('T')[0];
        const gmtPlus8Offset = 8 * 60 * 60 * 1000;

        const timezone = date => new Date(date.getTime() + gmtPlus8Offset);

        let today = new Date();
        let startDate, endDate;

        switch (period) {
            case 'day':
                startDate = endDate = formatDate(timezone(today));
                break;
            case 'week':
                let startOfWeek = new Date(today);
                startOfWeek.setDate(today.getDate() - today.getDay());
                startDate = formatDate(timezone(startOfWeek));

                let endOfWeek = new Date(today);
                endOfWeek.setDate(today.getDate() + (6 - today.getDay()));
                endDate = formatDate(timezone(endOfWeek));
                break;
            case 'month':
                let startOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                startDate = formatDate(timezone(startOfMonth));

                let endOfMonth = new Date(today.getFullYear(), today.getMonth() + 1, 0);
                endDate = formatDate(timezone(endOfMonth));
                break;
        }

        document.getElementById('start_date').value = startDate;
        document.getElementById('end_date').value = endDate;

        location.href = `index.php?page=records&uid=${encodeURIComponent(uid)}&type=${encodeURIComponent(type)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
    }
</script>