<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1 class="m-0">Archived Data</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="row">

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="index.php?page=archived_employees" style="text-decoration: none; color: inherit;">
                        <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="fa-solid fa-user-tie"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Employee</span>
                                <span class="info-box-number">222</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="index.php?page=archived_students" style="text-decoration: none; color: inherit;">
                        <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="fa-solid fa-graduation-cap"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Student</span>
                                <span class="info-box-number">222</span>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="index.php?page=archived_visitors" style="text-decoration: none; color: inherit;">
                        <div class="info-box">
                            <span class="info-box-icon bg-primary"><i class="fa-solid fa-person-walking"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Visitor</span>
                                <span class="info-box-number">222</span>
                            </div>
                        </div>
                    </a>
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