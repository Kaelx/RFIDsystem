<div class="content-wrapper d-flex flex-column">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        </div>
    </div>
    <!-- RFID FORM -->
    <form action="" id="rfid-form">
        <div>
            <input type="text" id="rfid" name="rfid" required autofocus>
        </div>
    </form>

    <!-- Main content -->
    <section class="content flex-grow-1 d-flex flex-column">
        <div class="container-fluid h-100 d-flex flex-column">

            <!-- Card with clock and user info -->
            <div class="card flex-grow-1 d-flex flex-column">
                <div class="card-body flex-grow-1 d-flex flex-column justify-content-between">
                    <!-- Clock and Date Display -->
                    <center>
                        <div class="mb-4">
                            <div id="clock" class="display-4 font-weight-bold"></div>
                            <div id="date" class="h2"></div>
                        </div>
                    </center>

                    <!-- User Information Display -->
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-md-5 text-center">
                            <img id="profile-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; width: 450px; height: 450px;">
                        </div>
                        <div class="col-md-5">
                            <div class="row">
                                <div class="col-md-4 mb-2">
                                    <input type="text" id="fname" class="form-control form-control-lg" placeholder="First Name">
                                </div>
                                <div class="col-md-4 mb-2">
                                    <input type="text" id="lname" class="form-control form-control-lg" placeholder="Last Name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-8">
                                    <input type="text" id="gender" class="form-control form-control-lg mb-2" placeholder="Gender">
                                </div>
                                <div class="col-md-8 ">
                                    <input type="text" id="type" class="form-control form-control-lg mb-2" placeholder="Role">
                                </div>
                                <div class="col-md-8">
                                    <input type="text" id="school_id" class="form-control form-control-lg mb-2" placeholder="School ID">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Add any other content here -->

        </div>
    </section>

    <!-- The lower card that should always be at the bottom -->
    <div class="card mt-auto">
        <div class="table-responsive">
            <table class="table table-hover table-sm compact">
                <thead>
                    <tr>
                        <th class="text-center">Name</th>
                        <th class="text-center">Time in</th>
                        <th class="text-center">Time out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $rec = $conn->query("SELECT r.id, r.timein, r.timeout,
                                        COALESCE(s.fname, e.fname, v.fname) as fname,
                                        COALESCE(s.mname, e.mname, v.mname) as mname,
                                        COALESCE(s.lname, e.lname, v.lname) as lname
                                    FROM records r
                                    LEFT JOIN students s ON r.recordable_id = s.id AND r.recordable_table = 'students'
                                    LEFT JOIN employees e ON r.recordable_id = e.id AND r.recordable_table = 'employees'
                                    LEFT JOIN visitors v ON r.recordable_id = v.id AND r.recordable_table = 'visitors'
                                    ORDER BY GREATEST(r.timein, IFNULL(r.timeout, r.timein)) DESC
                                    LIMIT 5;
                                ");
                    if ($rec->num_rows > 0) {
                        while ($row = $rec->fetch_assoc()): ?>
                            <tr>
                                <td class="text-center"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']  ?></td>
                                <td class="text-center"><?= date('F d, Y -- h:i A', strtotime($row['timein'])) ?></td>
                                <td class="text-center"><?= $row['timeout'] ? date('F d, Y -- h:i A', strtotime($row['timeout'])) : '------' ?></td>
                            </tr>
                        <?php endwhile;
                    } else { ?>
                        <tr>
                            <td class="text-center text-bold" colspan="3">No data available in table</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





<script>
    // $('table').DataTable({
    //     ordering: false,
    //     searching: false,
    //     lengthChange: false,
    //     paging: false,
    //     pageLength: 5,
    //     info: false

    // });

    let idleTimer;
    let idleState = false;
    const idleWait = 5500;

    function resetIdleTimer() {
        clearTimeout(idleTimer);
        if (idleState) {
            idleState = false;
        }
        idleTimer = setTimeout(function() {
            idleState = true;

            $('#fname').val("");
            $('#lname').val("");
            $('#type').val("");
            $('#school_id').val("");
            $('#gender').val("");
            $('#profile-img').attr('src', 'assets/img/' + 'blank-img.png');
            $('#rfid').val("");

        }, idleWait);
    }

    $(document).on('mousemove click keypress scroll', resetIdleTimer);

    $(document).ready(function() {
        resetIdleTimer();
    });




    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;

        const options = {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        };
        const date = now.toLocaleDateString(undefined, options);

        document.getElementById('clock').innerText = `${hours}:${minutes}:${seconds} ${ampm}`;
        document.getElementById('date').innerText = date;
    }


    setInterval(updateClock, 1000);
    updateClock();

    setInterval(function() {
        $('#rfid').focus();
    }, 500);

    $('body').mousemove(function() {
        $('#rfid').focus();
    });






    $('#rfid-form').keypress(function(e) {
        if (e.which === 13) {
            e.preventDefault();

            $.ajax({
                url: 'ajax.php?action=fetch_data',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                success: function(resp) {

                    sessionStorage.setItem('responseData', resp);

                    location.reload();
                }
            });
        }
    });


    $(document).ready(function() {
        const responseData = sessionStorage.getItem('responseData');
        if (responseData) {
            console.log(responseData);

            sessionStorage.removeItem('responseData');

            const data = JSON.parse(responseData);
            const defaultVal = "Unknown";
            const imgPath = data.success ? `assets/img/${data.img_path}` : 'assets/img/unauth-img.png';

            $('#fname').val(data.success ? data.fname : defaultVal);
            $('#lname').val(data.success ? data.lname : defaultVal);
            $('#gender').val(data.success ? data.gender : defaultVal);
            $('#type').val(data.success ? data.role_name : defaultVal);
            $('#school_id').val(data.success ? data.school_id : defaultVal);
            $('#profile-img').attr('src', imgPath);
            $('#rfid').val("");

            if (!data.success) {
                const audio = new Audio('assets/defaults/alert_beep.mp3');
                audio.play();
            }
        }
    });
</script>