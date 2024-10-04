<?php

$start_date = isset($_GET['start_date']) ? ($_GET['start_date']) : '';
$end_date = isset($_GET['end_date']) ? ($_GET['end_date']) : '';
$filter_type = isset($_GET['filter_type']) ? $_GET['filter_type'] : '';

$query = "SELECT r.record_date, r.timein, r.timeout,
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
    WHERE COALESCE(s.status, e.status, v.status) = 0

";

// Add date filter if both dates are set
if (!empty($start_date) && !empty($end_date)) {
    $query .= " AND DATE(r.record_date) BETWEEN '$start_date' AND '$end_date'";
}

// Add filter for type if set
if (!empty($filter_type)) {
    if ($filter_type === 'student') {
        $query .= " AND s.id IS NOT NULL";
    } elseif ($filter_type === 'employee') {
        $query .= " AND e.id IS NOT NULL";
    } elseif ($filter_type === 'visitor') {
        $query .= " AND v.id IS NOT NULL";
    }
}

$query .= " ORDER BY r.id DESC";

$cats = $conn->query($query);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <a href="index.php?page=attendance_report" class="btn btn-warning"><i class="fa-solid fa-print"></i> Attendance Report</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header text-right">
                    <div class="row">
                        <div class="ml-2">
                            <form action="#" id="filter-report" class="form-inline d-flex align-items-center">
                                <div class="form-group mb-2 mr-2 d-flex align-items-center">
                                    <label for="start_date" class="mr-2">Date:</label>
                                    <input type="date" name="start_date" id="start_date" class="form-control"
                                        value="<?= $start_date; ?>">
                                </div>
                                <div class="form-group mb-2 mr-2 d-flex align-items-center">
                                    <label for="end_date" class="mr-2">To </label>
                                    <input type="date" name="end_date" id="end_date" class="form-control"
                                        value="<?= $end_date; ?>">
                                </div>
                                <button type="submit" class="btn btn-primary mb-2">Search</button>
                            </form>
                        </div>

                        <div class="ml-auto mr-2">
                            <div class="row">
                                <div class="dropdown">
                                    <button id="dropdownSubMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="btn btn-secondary dropdown-toggle">Filter</button>
                                    <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                                        <li><a href="#" class="dropdown-item" onclick="filterBy('employee')">Employee</a></li>
                                        <li><a href="#" class="dropdown-item" onclick="filterBy('student')">Student</a></li>
                                        <li><a href="#" class="dropdown-item" onclick="filterBy('visitor')">Visitor</a></li>
                                    </ul>
                                </div>
                                <button type="button" class="btn btn-default ml-3" id="clear-filters">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">School ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Role</th>
                                    <th class="text-center">Date</th>
                                    <th class="text-center">Time in</th>
                                    <th class="text-center">Time out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $i = 1;
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-left"><?php echo (isset($row['school_id']) ? $row['school_id'] : 'N/A'); ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                        <td class="text-left"><?php echo $row['role_name']; ?></td>
                                        <td>
                                            <?php
                                            $date = new DateTime($row['record_date']);
                                            echo $date->format('F j, Y');
                                            ?></td>
                                        <td class="text-center">
                                            <?php
                                            $timein = new DateTime($row['timein']);
                                            echo $timein->format('h:i A');
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?php
                                            if (!empty($row['timeout'])) {
                                                $timeout = new DateTime($row['timeout']);
                                                echo $timeout->format('h:i A');
                                            } else {
                                                echo '------';
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
        stateSave: true,
        layout: {
            topStart: 'search',
            topEnd: 'pageLength',
        }
    });

    $('#filter-report').submit(function(e) {
        e.preventDefault();

        // Get the current filter type
        let filterType = new URLSearchParams(window.location.search).get('filter_type') || '';

        // Redirect with the serialized form data and filter type
        location.href = 'index.php?page=entrylogs&' + $(this).serialize() + '&filter_type=' + filterType;
    });


    function filterBy(type) {
        let startDate = document.getElementById('start_date').value;
        let endDate = document.getElementById('end_date').value;

        // Redirect with selected filter type
        location.href = `index.php?page=entrylogs&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}&filter_type=${type}`;
    }

    $('#generate-report').click(function() {
        const startDate = $('#start_date').val();
        const endDate = $('#end_date').val();

        let filterType = new URLSearchParams(window.location.search).get('filter_type') || '';

        window.location.href = `index.php?page=generate_report&start_date=${encodeURIComponent(startDate)}&end_date=${encodeURIComponent(endDate)}` + '&filter_type=' + filterType;
    });


    $('#clear-filters').click(function() {
        $('#start_date').val('');
        $('#end_date').val('');

        const baseUrl = 'index.php?page=entrylogs';
        location.href = baseUrl;
    });
</script>