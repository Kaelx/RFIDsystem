<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow" id="card-type-of-people">
                <div class="card-header text-bold">
                    Role Type
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>

                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <!-- FORM Panel -->
                            <div class="col-md-4">
                                <form action="" id="set-category">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" autocomplete="name" required>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                                    <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#set-category').get(0).reset()"> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Table Panel -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover compact">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center w-50">People</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $cats = $conn->query("SELECT * FROM category order by id asc");
                                                    while ($row = $cats->fetch_assoc()):
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i++ ?></td>
                                                            <td class="">
                                                                <?php echo $row['cat_name'] ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['cat_name'] ?>">Edit</button>
                                                                <button class="btn btn-sm btn-danger col-sm-3 delete_cat" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <hr>



            <div class="card shadow" id="card-school-department">
                <div class="card-header text-bold">
                    School Department
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <!-- FORM Panel -->
                            <div class="col-md-4">
                                <form action="" id="set2-category">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" autocomplete="name" required>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                                    <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#set2-category').get(0).reset()"> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Table Panel -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover compact">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center w-50">Department</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $cats = $conn->query("SELECT * FROM department order by id asc");
                                                    while ($row = $cats->fetch_assoc()):
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i++ ?></td>
                                                            <td class="">
                                                                <?php echo $row['dept_name'] ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat2 " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['dept_name'] ?>">Edit</button>
                                                                <button class="btn btn-sm btn-danger col-sm-3 delete_cat2" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <hr>


            <div class="card shadow" id="card-school-program">
                <div class="card-header text-bold">
                    School Program
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <div class="col-lg-12">
                        <div class="row">
                            <!-- FORM Panel -->
                            <div class="col-md-4">
                                <form action="" id="set3-category">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="id">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" autocomplete="name" required>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                                    <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#set3-category').get(0).reset()"> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Table Panel -->
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover compact">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center w-50">Program</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $cats = $conn->query("SELECT * FROM program order by id asc");
                                                    while ($row = $cats->fetch_assoc()):
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i++ ?></td>
                                                            <td class="">
                                                                <?php echo $row['prog_name'] ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat3 " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['prog_name'] ?>">Edit</button>
                                                                <button class="btn btn-sm btn-danger col-sm-3 delete_cat3" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
                                                            </td>
                                                        </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>



<script src="js/category.js"></script>