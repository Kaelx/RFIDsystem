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

    <div class="content-header">

        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

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


                        <div class="card card-danger card-outline">
                            <div class="card-body box-profile">
                                <div class="text-center">
                                    <?php if (isset($member['img_path']) && !empty($member['img_path'])): ?>
                                        <img class="profile-user-img img-fluid img-circle" src="<?= 'assets/img/' . $member['img_path'] ?>" alt="User profile picture" id="profileImage">
                                    <?php else: ?>
                                        <img class="profile-user-img img-fluid img-circle" src="assets/img/blank-img.png" alt="Default Profile Picture" id="profileImage">
                                    <?php endif; ?>
                                </div>

                                <h3 class="profile-username text-center"><?= $member['fname'] . ' ' . $member['mname'] . ' ' . $member['lname'] ?></h3>

                                <p class="text-muted text-center"><?= $member['role_name'] ?></p>
                            </div>
                        </div>


                    </div>
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-header p-2">
                                <div class="row">
                                    <div class="ml-2">
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
                                        </form>
                                    </div>

                                    <div class="ml-auto mr-2">
                                        <div class="dropdown mb-2">
                                            <button id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Filter</button>
                                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item" onclick="filterBy('day')">This Day</a></li>
                                                <li><a href="#" class="dropdown-item" onclick="filterBy('week')">This Week</a></li>
                                                <li><a href="#" class="dropdown-item" onclick="filterBy('month')">This Month</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="tab-content">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-bordered compact">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">#</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Date</th>
                                                    <th class="text-center">Time in</th>
                                                    <th class="text-center">Time out</th>
                                                    <th class="text-center">Duration</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php

                                                $query = "SELECT r.record_date,r.timein, r.timeout,
                                                                COALESCE(s.fname, e.fname, v.fname) AS fname, 
                                                                COALESCE(s.mname, e.mname, v.mname) AS mname, 
                                                                COALESCE(s.lname, e.lname, v.lname) AS lname,
                                                                COALESCE(s.school_id, e.school_id, NULL) AS school_id,
                                                                COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name
                                                            FROM records r
                                                            LEFT JOIN students s ON r.record_id = s.id AND r.record_table = 'students'
                                                            LEFT JOIN employees e ON r.record_id = e.id AND r.record_table = 'employees'
                                                            LEFT JOIN visitors v ON r.record_id = v.id AND r.record_table = 'visitors'
                                                            LEFT JOIN role r_s ON s.role_id = r_s.id
                                                            LEFT JOIN role r_e ON e.role_id = r_e.id
                                                            LEFT JOIN role r_v ON v.role_id = r_v.id
                                                            WHERE r.record_id = '$uid' and r.record_table = '$type'
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
                                                        <td class="text-center">
                                                            <?php
                                                            $date = new DateTime($row['record_date']);
                                                            echo $date->format('F j, Y');
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            $timein = new DateTime($row['timein']);
                                                            echo $timein->format('g:i A');
                                                            ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                            if (!empty($row['timeout'])) {
                                                                $timeout = new DateTime($row['timeout']);
                                                                echo $timeout->format('g:i A');
                                                            } else {
                                                                echo '------';
                                                            }
                                                            ?>
                                                        </td>
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

                        <div class="m-3 text-right">
                            <button id="generate-reportv2" class="btn btn-warning"><i class="fa-solid fa-file-export"></i> Generate Report</button>
                            <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script>
        $('table').DataTable({
            ordering: false,
            searching: false,
            stateSave: true,
            layout: {
                topStart: null,
                topEnd: 'pageLength',
            }
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


        $('#generate-reportv2').click(function() {
            var uid = "<?php echo $uid; ?>";
            var type = "<?php echo $type; ?>";
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            window.location.href = `index.php?page=generate_reportv2&uid=${encodeURIComponent(uid)}&type=${encodeURIComponent(type)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
        });
    </script>