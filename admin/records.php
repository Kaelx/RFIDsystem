<?php

if (!isset($_GET['rfid'])) {
    header('Location: index.php?page=home');
}

$rfid = $_GET['rfid'];

echo $rfid;

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : date('Y-m-d');
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : date('Y-m-d');


if (strtotime($end_date) < strtotime($start_date)) {
    $end_date = $start_date;
}

$query = "SELECT r.id, r.rfid_num, r.timein, r.timeout, 
            COALESCE(s.fname, e.fname) AS fname, 
            COALESCE(s.mname, e.mname) AS mname, 
            COALESCE(s.lname, e.lname) AS lname,
            COALESCE(s.school_id, e.school_id) AS school_id,
            COALESCE(r_s.role_name, r_e.role_name) AS role_name
            FROM records r
            LEFT JOIN students s ON r.rfid_num = s.rfid
            LEFT JOIN employees e ON r.rfid_num = e.rfid
            LEFT JOIN role r_s ON s.role_id = r_s.id
            LEFT JOIN role r_e ON e.role_id = r_e.id
            WHERE r.timein IS NOT NULL 
            AND r.timeout IS NOT NULL 
            AND DATE(r.timein) BETWEEN '$start_date' AND '$end_date'
            AND DATE(r.timeout) BETWEEN '$start_date' AND '$end_date'
            AND r.rfid_num = '$rfid'
            ORDER BY r.id ASC;";

$cats = $conn->query($query);

if (!$cats) {
    echo "Error: " . $conn->error;
}
?>






<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">

            <form action="#" id="filter-report" class="form-inline">
                <input type="hidden" name="rfid" value="<?= $rfid ?>">
                <div class="form-group mb-2">
                    <label for="start_date">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm mr-2"
                        value="<?= isset($_GET['start_date']) ? $_GET['start_date'] : date('Y-m-d') ?>">
                </div>
                <div class="form-group mb-2">
                    <label for="end_date">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm mr-2"
                        value="<?= isset($_GET['end_date']) ? $_GET['end_date'] : date('Y-m-d') ?>">
                </div>
                <button type="submit" class="btn btn-primary mb-2">Filter</button>
            </form>

            <button id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Action</button>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="#" class="dropdown-item" onclick="filterBy('day')">This Day</a></li>
                <li><a href="#" class="dropdown-item" onclick="filterBy('week')">This Week</a></li>
                <li><a href="#" class="dropdown-item" onclick="filterBy('month')">This Month</a></li>
            </ul>


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
                                    <th class="text-center">School ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Time in</th>
                                    <th class="text-center">Time out</th>
                                    <th class="text-center">Duration</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $i = 1;
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-left"><?php echo $row['school_id']; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td class="text-left""><?php echo $row['role_name']; ?></td>
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

        var serializedData = $(this).find(':input').filter(function() {
            return $.trim(this.value).length > 0;
        }).serialize();

        location.href = 'index.php?page=records&' + serializedData;
    });



    function filterBy(period) {
        var today = new Date();
        var startDate, endDate;

        switch (period) {
            case 'day':
                startDate = endDate = today.toISOString().split('T')[0];
                break;
            case 'week':
                // Get the start of the week (Sunday)
                var firstDayOfWeek = new Date(today.setDate(today.getDate() - today.getDay()));
                startDate = firstDayOfWeek.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
            case 'month':
                // Get the first day of the current month
                var firstDayOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
                startDate = firstDayOfMonth.toISOString().split('T')[0];
                endDate = new Date().toISOString().split('T')[0];
                break;
        }

        // Set the date fields and submit the form
        document.getElementById('start_date').value = startDate;
        document.getElementById('end_date').value = endDate;

        // Serialize only non-empty fields
        var serializedData = $('#filter-report').find(':input').filter(function() {
            return $.trim(this.value).length > 0;
        }).serialize();

        location.href = 'index.php?page=records&' + serializedData;
    }
</script>