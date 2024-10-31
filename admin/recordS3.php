<?php

do {
    $report_id = rand(100000000, 999999999);
} while ($conn->query("SELECT * FROM gen_reports WHERE report_id = '$report_id'")->num_rows > 0);

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
                            case 'student':
                                $query = "SELECT s.id, s.fname, s.mname, s.lname, s.sname, s.school_id, r.role_name, NULL as employee_type, s.rfid, s.img_path, s.gender
                        FROM students s
                        LEFT JOIN role r ON s.role_id = r.id
                        WHERE s.id = '$uid'
                        ";
                                break;

                            case 'employee':
                                $query = "SELECT e.id, e.fname, e.mname, e.lname, e.sname, et.employee_type, e.school_id, r.role_name, e.rfid, e.img_path, e.gender
                        FROM employees e
                        LEFT JOIN role r ON e.role_id = r.id
                        LEFT JOIN employee_type et ON e.employee_type_id = et.id
                        WHERE e.id = '$uid'
                        ";
                                break;

                            case 'visitor':
                                $query = "SELECT v.id, v.fname, v.mname, v.lname, v.sname, NULL as school_id, r.role_name, NULL as employee_type, v.rfid, v.img_path, v.gender
                        FROM visitors v
                        LEFT JOIN role r ON v.role_id = r.id
                        WHERE v.id = '$uid'
                        ";
                                break;

                            case 'vendor':
                                $query = "SELECT cv.id, cv.fname, cv.mname, cv.lname, cv.sname, NULL as school_id, r.role_name, NULL as employee_type, cv.rfid, cv.img_path, cv.gender
                            FROM vendors cv
                            LEFT JOIN role r ON cv.role_id = r.id
                            WHERE cv.id = '$uid'
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

                                <h3 class="profile-username text-center">
                                    <?= $member['fname'] . ' ' . (isset($member['mname']) && !empty($member['mname']) ? $member['mname'] . '.' : '') . ' ' . $member['lname'] . ' ' . (isset($member['sname']) && !empty($member['sname']) ? $member['sname'] : '')  ?>
                                </h3>

                                <p class="text-center no-space"><?= $member['role_name']; ?></p>
                                <p class="text-center no-space"><?= $member['employee_type']; ?></p>
                                <p class="text-center no-space"><?= $member['school_id']; ?></p>

                            </div>
                        </div>


                    </div>
                    <div class="col-md-9">
                        <div class="card">

                            <div class="card-header">
                                <div class="row d-flex justify-content-between align-items-center">
                                    <!-- Filter Form -->
                                    <div class="col-12 col-md-8 mb-3 mb-md-0">
                                        <form action="#" id="filter-report" class="form-inline d-flex flex-wrap align-items-center">
                                            <div class="form-group mb-2 mr-md-2 d-flex align-items-center">
                                                <label for="start_date" class="mr-2">Date:</label>
                                                <input type="date" name="start_date" id="start_date" class="form-control"
                                                    value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                                            </div>
                                            <div class="form-group mb-2 mr-md-2 d-flex align-items-center">
                                                <label for="end_date" class="mr-2">To</label>
                                                <input type="date" name="end_date" id="end_date" class="form-control"
                                                    value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary mb-2 mr-md-2">
                                                <i class="fa-solid fa-magnifying-glass"></i>
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Date Filter Dropdown -->
                                    <div class="col-12 col-md-4 d-flex justify-content-center justify-content-md-end">
                                        <div class="dropdown">
                                            <button id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                                class="btn btn-secondary dropdown-toggle">Date</button>
                                            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                                <li><a href="#" class="dropdown-item" onclick="filterBy(' ')">Clear Filter</a></li>
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
                                        <?php
                                        // Adjusted Query to Select All Entries for a Date
                                        $query = "SELECT r.record_date, r.timein, r.timeout,
                                        COALESCE(s.fname, e.fname, v.fname) AS fname,
                                        COALESCE(s.mname, e.mname, v.mname) AS mname,
                                        COALESCE(s.lname, e.lname, v.lname) AS lname,
                                        COALESCE(s.school_id, e.school_id, NULL) AS school_id,
                                        COALESCE(r_s.role_name, r_e.role_name, r_v.role_name) AS role_name
                                        FROM records r
                                        LEFT JOIN students s ON r.record_id = s.id AND r.record_table = 'student'
                                        LEFT JOIN employees e ON r.record_id = e.id AND r.record_table = 'employee'
                                        LEFT JOIN visitors v ON r.record_id = v.id AND r.record_table = 'visitor'
                                        LEFT JOIN role r_s ON s.role_id = r_s.id
                                        LEFT JOIN role r_e ON e.role_id = r_e.id
                                        LEFT JOIN role r_v ON v.role_id = r_v.id
                                        WHERE r.record_id = '$uid' and r.record_table = '$type'";

                                        if (!empty($start_date) && !empty($end_date)) {
                                            $query .= " AND DATE(r.record_date) BETWEEN '$start_date' AND '$end_date'";
                                        }

                                        $query .= " ORDER BY r.record_date DESC, r.timein ASC"; // Ensure ordered by date and time

                                        $result = $conn->query($query);

                                        $records_by_date = [];

                                        // Process Result to Organize Entries by Date
                                        while ($row = $result->fetch_assoc()) {
                                            $date = $row['record_date'];
                                            $timein = !empty($row['timein']) && $row['timein'] != '00:00:00' ? new DateTime($row['timein']) : null;
                                            $timeout = !empty($row['timeout']) && $row['timeout'] != '00:00:00' ? new DateTime($row['timeout']) : null;

                                            if (!isset($records_by_date[$date])) {
                                                $records_by_date[$date] = [
                                                    'am_timein' => '------',
                                                    'am_timeout' => '------',
                                                    'pm_timein' => '------',
                                                    'pm_timeout' => '------'
                                                ];
                                            }

                                            // Determine A.M. or P.M. for each time and assign appropriately
                                            if ($timein) {
                                                if ($timein->format('A') == 'AM') {
                                                    $records_by_date[$date]['am_timein'] = $timein->format('h:i A');
                                                } else {
                                                    $records_by_date[$date]['pm_timein'] = $timein->format('h:i A');
                                                }
                                            }

                                            if ($timeout) {
                                                if ($timeout->format('A') == 'AM') {
                                                    $records_by_date[$date]['am_timeout'] = $timeout->format('h:i A');
                                                } else {
                                                    $records_by_date[$date]['pm_timeout'] = $timeout->format('h:i A');
                                                }
                                            }
                                        }

                                        $i = 1;
                                        ?>
                                        <table class="table text-nowrap table-hover table-bordered compact">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" rowspan="2">#</th>
                                                    <th class="text-center w-25" rowspan="2">Date</th>
                                                    <th class="text-center" colspan="2">A.M.</th>
                                                    <th class="text-center" colspan="2">P.M.</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">Time in</th>
                                                    <th class="text-center">Time out</th>
                                                    <th class="text-center">Time in</th>
                                                    <th class="text-center">Time out</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($records_by_date as $date => $times): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $i++; ?></td>
                                                        <td class="text-center"><?= (new DateTime($date))->format('F d, Y'); ?></td>
                                                        <td class="text-center"><?= $times['am_timein']; ?></td>
                                                        <td class="text-center"><?= $times['am_timeout']; ?></td>
                                                        <td class="text-center"><?= $times['pm_timein']; ?></td>
                                                        <td class="text-center"><?= $times['pm_timeout']; ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>


                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <?php if ($_SESSION['login_account_type'] != 3): ?>
                                <form action="" id="report_id">
                                    <input type="hidden" name="report_id" value="<?php echo $report_id ?>">
                                    <button type="submit" class="btn btn-warning m-2"><i class="fa-solid fa-print"></i> Generate Report</button>
                                </form>
                            <?php endif; ?>
                            <button id="generate-report" style="display:none;"></button>


                            <button type="button" class="btn btn-secondary btn-custom m-2" onclick="window.history.back(); return false;">Back</button>
                            <!-- <button type="button" class="btn btn-secondary btn-custom m-2" id="back-btn">Back</button> -->
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


        $('#back-btn').click(function() {
            var uid = "<?php echo $uid; ?>";
            var type = "<?php echo $type; ?>";

            if (type === 'student') {
                window.location.href = 'index.php?page=student_view&uid=' + uid;
            } else if (type === 'employee') {
                window.location.href = 'index.php?page=employee_view&uid=' + uid;
            } else if (type === 'visitor') {
                window.location.href = 'index.php?page=visitor_view&uid=' + uid;
            } else {
                console.error('Unknown user type:', type); // Optional: Handle unknown types
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
                default:
                    // If no period is specified, clear the date values
                    startDate = '';
                    endDate = '';
                    break;
            }

            document.getElementById('start_date').value = startDate;
            document.getElementById('end_date').value = endDate;

            location.href = `index.php?page=records&uid=${encodeURIComponent(uid)}&type=${encodeURIComponent(type)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
        }



        $('#report_id').submit(function(e) {
            e.preventDefault();

            if (!confirm('Are you sure you want to generate report?')) return;
            $.ajax({
                url: 'ajax.php?action=request_report',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    console.log(resp);
                    $('#generate-report').trigger('click');
                }
            })
        });



        $('#generate-report').click(function() {
            var uid = "<?php echo $uid; ?>";
            var type = "<?php echo $type; ?>";
            var report_id = "<?php echo $report_id; ?>";
            var startDate = $('#start_date').val();
            var endDate = $('#end_date').val();

            window.location.href = `index.php?page=generate_report&uid=${encodeURIComponent(uid)}&type=${encodeURIComponent(type)}&report_id=${encodeURIComponent(report_id)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
        });
    </script>