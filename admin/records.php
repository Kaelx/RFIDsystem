<?php

if (!isset($_GET['rfid'])) {
    header('Location: index');
}

$rfid = $_GET['rfid'];
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
                    $query = "SELECT r.rfid_num, r.timein, r.timeout, 
                        COALESCE(s.fname, e.fname) AS fname, 
                        COALESCE(s.mname, e.mname) AS mname, 
                        COALESCE(s.lname, e.lname) AS lname,
                        COALESCE(s.img_path, e.img_path) AS img_path,
                        COALESCE(s.school_id, e.school_id) AS school_id,
                        COALESCE(r_s.role_name, r_e.role_name) AS role_name,
                        COALESCE(g_s.gender, g_e.gender) AS gender
                        FROM records r
                        LEFT JOIN students s ON r.rfid_num = s.rfid
                        LEFT JOIN employees e ON r.rfid_num = e.rfid
                        LEFT JOIN role r_s ON s.role_id = r_s.id
                        LEFT JOIN role r_e ON e.role_id = r_e.id
                        LEFT JOIN gender g_s ON s.gender_id = g_s.id
                        LEFT JOIN gender g_e ON e.gender_id = g_e.id
                        WHERE r.rfid_num = '$rfid'
                        ";

                    $result = $conn->query($query);
                    $member = $result->fetch_assoc();

                    ?>

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
                                <div class="col-md-6">
                                    <p class="form-control form-control-sm"><?= $member['fname'] . ' ' . $member['mname'] . ' ' . $member['lname'] ?></p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <p class="form-control form-control-sm"><?= $member['gender'] ?></p>
                                </div>
                                <div class="col-md-3">
                                    <p class="form-control form-control-sm"><?= $member['role_name'] ?></p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <p class="form-control form-control-sm"><?= $member['school_id'] ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <form action="#" id="filter-report" class="form-inline d-flex align-items-center">
                        <input type="hidden" name="rfid" value="<?= $rfid ?>">
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="start_date" class="mr-2">Start Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : '' ?>">
                        </div>
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="end_date" class="mr-2">End Date:</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : '' ?>">
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

                                $query = "SELECT r.rfid_num, r.timein, r.timeout, 
                                        COALESCE(s.fname, e.fname) AS fname, 
                                        COALESCE(s.mname, e.mname) AS mname, 
                                        COALESCE(s.lname, e.lname) AS lname,
                                        COALESCE(s.school_id, e.school_id) AS school_id,
                                        COALESCE(r_s.role_name, r_e.role_name) AS role_name,
                                        COALESCE(g_s.gender, g_e.gender) AS gender
                                        FROM records r
                                        LEFT JOIN students s ON r.rfid_num = s.rfid
                                        LEFT JOIN employees e ON r.rfid_num = e.rfid
                                        LEFT JOIN role r_s ON s.role_id = r_s.id
                                        LEFT JOIN role r_e ON e.role_id = r_e.id
                                        LEFT JOIN gender g_s ON s.gender_id = g_s.id
                                        LEFT JOIN gender g_e ON e.gender_id = g_e.id
                                        WHERE r.rfid_num = '$rfid'";

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
                                        <td class="text-left">
                                            <?php
                                            if (!empty($row['timein']) && !empty($row['timeout'])) {
                                                // Convert timein and timeout to timestamps
                                                $timein = strtotime($row['timein']);
                                                $timeout = strtotime($row['timeout']);

                                                // Calculate the difference in seconds
                                                $duration_in_seconds = $timeout - $timein;

                                                // Convert to hours and minutes
                                                $hours = floor($duration_in_seconds / 3600);  // Total hours
                                                $minutes = floor(($duration_in_seconds % 3600) / 60);  // Remaining minutes

                                                // Display hours and minutes
                                                echo $hours . ' hours, ' . $minutes . ' minutes';
                                            } else {
                                                // If timeout or timein is empty, display "In Progress" or another message
                                                echo 'In Progress';
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
        stateSave: true
    });



    $('#filter-report').submit(function(e) {
        e.preventDefault();

        location.href = 'index.php?page=records&' + $(this).serialize();
    });


    function filterBy(period) {

        var rfid = "<?php echo $rfid; ?>";
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

        location.href = `index.php?page=records&rfid=${encodeURIComponent(rfid)}&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
    }
</script>