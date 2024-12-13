<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-lg mb-4" id="card-school-department">
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
                                                <input type="text" class="form-control" name="name" placeholder="Enter Department Name">
                                            </div>
                                            <div class="form-group">
                                                <label for="myColor" class="form-label">Choose color</label>
                                                <input type="color" class="form-control form-control-color" id="myColor" name="colorpick" value="#000000" title="Choose a color">
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
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap table-hover compact">
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
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat2 " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['dept_name'] ?>" data-color="<?php echo $row['color'] ?>">Edit</button>
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


            <div class="card shadow-lg mb-4 " id="card-school-program">
                <div class="card-header text-bold">
                    School Program/Course
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
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Program/Course Name">
                                            </div>

                                            <div class="form-group">
                                                <label for="dept_id"> Choose department</label>
                                                <select class="form-control" name="dept_id" id="dept_id" required>
                                                    <option value="" selected disabled>-- Select --</option>
                                                    <?php
                                                    $i = 1;
                                                    $program = $conn->query("SELECT * FROM department order by id asc ");
                                                    while ($row = $program->fetch_assoc()) :
                                                    ?>
                                                        <option value="<?php echo $row['id'] ?>"><?php echo $i . '. ' . $row['dept_name'] ?></option>

                                                    <?php
                                                        $i++;
                                                    endwhile; ?>
                                                </select>
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
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap table-hover compact">
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
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat3 " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['dept_id'] ?>" data-name2="<?php echo $row['prog_name'] ?>">Edit</button>
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


            <hr>


            <div class="card shadow-lg mb-4 " id="card-school-position">
                <div class="card-header text-bold">
                    Employee Position
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
                                <form action="" id="set4-category">
                                    <div class="card">
                                        <div class="card-body">
                                            <input type="hidden" name="id">

                                            <div class="form-group">
                                                <input type="text" class="form-control" name="name" id="name" placeholder="Enter Employee Position">
                                            </div>

                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <button class="btn btn-sm btn-primary col-sm-3 offset-md-3"> Save</button>
                                                    <button class="btn btn-sm btn-default col-sm-3" type="button" onclick="$('#set4-category').get(0).reset()"> Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Table Panel -->
                            <div class="col-md-8">
                                <div class="card shadow-none">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table text-nowrap table-hover compact">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">#</th>
                                                        <th class="text-center w-50">Position</th>
                                                        <th class="text-center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $i = 1;
                                                    $cats = $conn->query("SELECT * FROM employee_type order by id asc");
                                                    while ($row = $cats->fetch_assoc()):
                                                    ?>
                                                        <tr>
                                                            <td class="text-center"><?php echo $i++ ?></td>
                                                            <td class="">
                                                                <?php echo $row['employee_type'] ?>
                                                            </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-sm btn-secondary col-sm-3 edit_cat4 " type="button" data-id="<?php echo $row['id'] ?>" data-name="<?php echo $row['employee_type'] ?>">Edit</button>
                                                                <button class="btn btn-sm btn-danger col-sm-3 delete_cat4" type="button" data-id="<?php echo $row['id'] ?>">Delete</button>
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



<script>
    $('table').DataTable({
        ordering: false,
        lengthChange: false,
        info: false,
        layout: {
            bottom: 'paging',
            bottomEnd: null
        },
        pagingType: 'simple',
        // language: {
        //     paginate: {
        //         previous: "< Previous", 
        //         next: "Next Page >"
        //     }
        // }
    })



    $('#set2-category').submit(function(e) {
        e.preventDefault()

        // Validate the form before AJAX submission
        if (!$(this).valid()) {
            return;
        }

        start_load();
        $.ajax({
            url: 'ajax.php?action=save_category2',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                console.log(resp);

                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })

    $('#set3-category').submit(function(e) {
        e.preventDefault()

        // Validate the form before AJAX submission
        if (!$(this).valid()) {
            return;
        }

        start_load();
        $.ajax({
            url: 'ajax.php?action=save_category3',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })


    $('#set4-category').submit(function(e) {
        e.preventDefault()

        // Validate the form before AJAX submission
        if (!$(this).valid()) {
            return;
        }

        start_load();
        $.ajax({
            url: 'ajax.php?action=save_category4',
            data: new FormData($(this)[0]),
            cache: false,
            contentType: false,
            processData: false,
            method: 'POST',
            type: 'POST',
            success: function(resp) {
                console.log(resp);

                if (resp == 1) {
                    alert_toast("Data successfully added", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })




    $('.edit_cat2').click(function() {
        var cat = $('#set2-category')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='name']").val($(this).attr('data-name'))
        cat.find("[name='colorpick']").val($(this).attr('data-color'))
    })

    $('.edit_cat3').click(function() {
        var cat = $('#set3-category')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='dept_id']").val($(this).attr('data-name'))
        cat.find("[name='name']").val($(this).attr('data-name2'))
    })

    $('.edit_cat4').click(function() {
        var cat = $('#set4-category')
        cat.get(0).reset()
        cat.find("[name='id']").val($(this).attr('data-id'))
        cat.find("[name='name']").val($(this).attr('data-name'))
    })



    $('.delete_cat2').click(function() {
        _conf("Are you sure to delete this department?", "delete_cat2", [$(this).attr('data-id')])
    })

    $('.delete_cat3').click(function() {
        _conf("Are you sure to delete this program?", "delete_cat3", [$(this).attr('data-id')])
    })

    $('.delete_cat4').click(function() {
        _conf("Are you sure to delete this position?", "delete_cat4", [$(this).attr('data-id')])
    })




    function delete_cat2($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_category2',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'warning')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                }
            }
        })
    }

    function delete_cat3($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_category3',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'warning')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                }
            }
        })
    }


    function delete_cat4($id) {

        start_load();
        $.ajax({
            url: 'ajax.php?action=delete_category4',
            method: 'POST',
            data: {
                id: $id
            },
            success: function(resp) {
                if (resp == 1) {
                    alert_toast("Data successfully deleted", 'warning')
                    setTimeout(function() {
                        location.reload()
                    }, 1000)

                }
            }
        })
    }




    // fold card
    $('.card').each(function() {
        var cardId = $(this).attr('id');
        if (cardId && sessionStorage.getItem(cardId) === 'true') {
            $(this).addClass('collapsed-card');
            $(this).find('.fas').removeClass('fa-minus').addClass('fa-plus');
        }
    });

    $('.btn-tool').on('click', function() {
        var card = $(this).closest('.card');
        var cardId = card.attr('id');
        var isCollapsed = card.hasClass('collapsed-card');

        if (isCollapsed) {
            sessionStorage.setItem(cardId, 'false');
            $(this).find('.fas').removeClass('fa-plus').addClass('fa-minus');
        } else {
            sessionStorage.setItem(cardId, 'true');
            $(this).find('.fas').removeClass('fa-minus').addClass('fa-plus');
        }
    });
</script>