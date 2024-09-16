<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Import</h1>
                </div>
            </div>
        </div>
    </div>


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form action="" id="import">
                <div class="form-group">
                    <label for="csv">CSV File</label><br>
                    <input type="file" name="csv" id="csv" accept=".csv" required>
                </div>
                <button class="btn btn-primary" type="submit">Upload</button>
            </form>
        </div>
    </section>

</div>

<script>
    $('#import').submit(function(e) {
        e.preventDefault()

        $.ajax({
            url: 'ajax.php?action=import',
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
                    }, 1500)

                } else if (resp == 2) {
                    alert_toast("Data successfully updated", 'success')
                    setTimeout(function() {
                        location.reload()
                    }, 1500)

                } else {
                    alert_toast("An error occured", 'danger')
                }
            },
            error: function(resp){
                console.log(resp);
            }
        })
    })
</script>