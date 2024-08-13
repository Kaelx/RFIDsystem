<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- button -->
                    <a href="index.php?page=register" class="btn btn-primary"><i class="fa-solid fa-user-pen"></i> Register</a>
                    <button type="button" class="btn btn-secondary"><i class="fa-solid fa-file-import"></i> Import</button>
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
                        <table class="table table-hover compact">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Program</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>natnat gege</td>
                                    <td>Computer studies</td>
                                    <td>Informatioon Tech</td>
                                    <td>natnat@example.com</td>
                                    <td>
                                        <button class="btn btn-success"> View</button>
                                    </td>
                                </tr>
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
        ordering:  false
    });
</script>