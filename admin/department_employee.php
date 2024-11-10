<?php

$dept_id = $_GET['department'];


$i = 1;

$cats = $conn->query("SELECT s.*, d.dept_name, d.color, r.role_name 
FROM employees s 
LEFT JOIN department d ON s.dept_id = d.id
LEFT JOIN role r ON s.role_id = r.id 
WHERE (r.role_name = 'employee' or 'employees' OR r.role_name IS NULL)
and s.status = 0 and s.dept_id = $dept_id
ORDER BY s.id ASC");

?>

<style>
    .small-card-header {
        font-size: 16px;
        padding: 5px;
    }
</style>


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
                <?php
                $sql = $conn->query("select * from department where id = $dept_id");
                $dept = $sql->fetch_assoc();
                ?>
                <div class="card-header small-card-header text-center text-bold text-white" style="background-color: <?php echo $dept['color'] ?>"><?php echo $dept['dept_name'] ?></div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap table-hover table-bordered compact">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center w-25">School ID</th>
                                    <th class="text-center w-75">Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                while ($row = $cats->fetch_assoc()):
                                ?>
                                    <tr onclick="window.location.href='index.php?page=employee_view&uid=<?= $row['id'] ?>'">
                                        <td class="text-center"><?= $i++; ?></td>
                                        <td class="text-center"><?php echo $row['school_id']; ?></td>
                                        <td class="text-left"><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                    </tr>

                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mr-5 m-2 text-right">
                    <button class="btn btn-secondary btn-custom" onclick="window.history.back(); return false;">Back</button>
                </div>
            </div>
        </div>


</div>
</section>
</div>
<script>
    $('table').DataTable({
        ordering: false,
        lengthChange: false,
        stateSave: true
    });
</script>