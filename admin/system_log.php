<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Audit Log</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="auditLogTable" class="table text-nowrap table-hover compact">
                            <thead>
                                <tr>
                                    <th>Description</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<script>
    $('#auditLogTable').DataTable({
        processing: true,
        serverSide: true,
        ordering: false,
        pageLength: 15,
        lengthMenu: [15, 50, 100],
        ajax: {
            url: 'ajax.php?action=fetch_logs',
            type: 'POST'
        },
        columns: [{
                data: 'description'
            },
            {
                data: 'time'
            }
        ],
        layout: {
            topStart: 'search',
            topEnd: 'pageLength',
        }
    });
</script>