<?php

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';


$query = "SELECT r.id, r.timein, r.timeout, 
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
";


// Add date filter if both dates are set
if (!empty($start_date) && !empty($end_date)) {
    $query .= " WHERE DATE(r.timein) BETWEEN '$start_date' AND '$end_date'
                AND DATE(r.timeout) BETWEEN '$start_date' AND '$end_date'";
}

$cats = $conn->query($query);

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="d-flex justify-content-center align-items-center">
                <div class="row">
                    <form action="#" id="filter-report" class="form-inline d-flex align-items-center">
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="start_date" class="mr-2">Date:</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="<?= isset($_GET['start_date']) ? ($_GET['start_date']) : '' ?>">
                        </div>
                        <div class="form-group mb-2 mr-2 d-flex align-items-center">
                            <label for="end_date" class="mr-2">To </label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="<?= isset($_GET['end_date']) ? ($_GET['end_date']) : '' ?>">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2 mr-2">Search</button>
                        <div class="dropdown mb-2 ml-5">
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
                                        <td class="text-left"><?php echo (isset($row['school_id']) ? $row['school_id'] : 'Visitor'); ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td class="text-left"><?php echo $row['role_name']; ?></td>
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
        stateSave: true
    });

    $('#filter-report').submit(function(e) {
        e.preventDefault();
        location.href = 'index.php?page=entrylogs&' + $(this).serialize();
    });




    function filterBy(period) {
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

        location.href = `index.php?page=entrylogs&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}`;
    }
</script>