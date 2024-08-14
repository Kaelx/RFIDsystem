<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="col-lg-12">
                <div class="row">
                    <!-- FORM Panel -->
                    <div class="col-md-4">
                        <form action="" id="set-category">
                            <div class="card">
                                <div class="card-header">
                                    Type of People
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" required>
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
                                                <th class="text-center">People</th>
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


            <hr>


            <div class="col-lg-12">
                <div class="row">
                    <!-- FORM Panel -->
                    <div class="col-md-4">
                        <form action="" id="set2-category">
                            <div class="card">
                                <div class="card-header">
                                    School Department
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="id">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="name" required>
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
                    <!-- FORM Panel -->

                    <!-- Table Panel -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover compact">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th class="text-center">Department</th>
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
                    <!-- Table Panel -->
                </div>
            </div>



        </div>
    </section>

</div>

<script>
    $('table').DataTable({
        ordering: false,
        paging: false,
        scrollY: 225
    })


    $('#set-category').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=save_category',
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
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }else{
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })

    $('#set2-category').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=save_category2',
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
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'info')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                }else{
                    alert_toast("An error occured", 'danger')
                }
            }
        })
    })


	$('.edit_cat').click(function(){
		var cat = $('#set-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
	})

    $('.edit_cat2').click(function(){
		var cat = $('#set2-category')
		cat.get(0).reset()
		cat.find("[name='id']").val($(this).attr('data-id'))
		cat.find("[name='name']").val($(this).attr('data-name'))
	})


    $('.delete_cat').click(function() {
        _conf("Are you sure to delete this category?", "delete_cat", [$(this).attr('data-id')])
    })

    $('.delete_cat2').click(function() {
        _conf("Are you sure to delete this department?", "delete_cat2", [$(this).attr('data-id')])
    })


	function delete_cat($id){
		$.ajax({
			url:'ajax.php?action=delete_category',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'warning')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}

    function delete_cat2($id){
		$.ajax({
			url:'ajax.php?action=delete_category2',
			method:'POST',
			data:{id:$id},
			success:function(resp){
				if(resp==1){
					alert_toast("Data successfully deleted",'warning')
					setTimeout(function(){
						location.reload()
					},1500)

				}
			}
		})
	}
</script>