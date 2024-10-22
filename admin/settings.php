<?php
$mode = $conn->query("SELECT * FROM settings ");

if ($mode->num_rows > 0) {
    $row = $mode->fetch_assoc();
    $mode = $row['mode']; // Fetch the 'mode' value

}

?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Settings</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">

                    <div class="form-group">
                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                            <input type="checkbox" class="custom-control-input" id="customSwitch3" <?php echo ($mode == 1) ? 'checked' : ''; ?>>
                            <label class="custom-control-label" for="customSwitch3">
                                <?php echo ($mode == 2) ? 'MODE: Single Scanner' : 'MODE: Separate Scanner'; ?>
                            </label>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>


<script>
    $('table').dataTable({
        ordering: false,
        stateSave: true,
        pageLength: 15,
        lengthMenu: [15, 50, 100],
        layout: {
            topStart: 'search',
            topEnd: 'pageLength',
        }

    });

    $('#customSwitch3').on('change', function() {
        if ($(this).is(':checked')) {

            start_load();
            $.ajax({
                url: 'ajax.php?action=mode',
                type: 'POST',
                data: {
                    mode: 1
                },
                success: function(resp) {
                    location.reload();
                }
            });

        } else {

            start_load();
            $.ajax({
                url: 'ajax.php?action=mode',
                type: 'POST',
                data: {
                    mode: 2
                },
                success: function(resp) {
                    location.reload();
                }
            });
        }
    });
</script>