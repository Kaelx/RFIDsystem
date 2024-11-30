<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Audit Log</h1>
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
                        <table class="table text-nowrap table-hover compact">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT l.*, u.fname, u.lname, u.account_type FROM logs l 
                                LEFT JOIN users u ON u.id = l.user_id
                                ORDER BY id DESC";
                                $result = $conn->query($sql);
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                ?>
                                        <tr>
                                            <td>
                                                <?php
                                                echo $row['fname'] . ' ' . $row['lname'] . ' (' .
                                                    ($row['account_type'] == 1 || $row['account_type'] == 0 ? 'admin' : ($row['account_type'] == 2 ? 'staff' : ($row['account_type'] == 3 ? 'security personnel' : 'unknown')))
                                                    . ') ' . $row['action'];
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                $date = new DateTime($row['timestamp']);
                                                echo $date->format('F j, Y, g:i A');
                                                ?>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>


<script>
    $('table').dataTable({
        ordering: false,
        pageLength: 15,
        lengthMenu: [15, 50, 100],
        layout: {
            topStart: 'search',
            topEnd: 'pageLength',
        }

    });
</script>