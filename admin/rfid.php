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
                <div class="card-body">

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
                            <img id="profile-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; max-width: 350px; max-height: 350px;">
                        </div>
                        <div class="col-md-5">

                            <div class="row">
                                <div class="col-md-4 form-group">
                                    <input type="text" id="fname" class="form-control form-control-lg" placeholder="First Name">
                                </div>
                                <div class="col-md-2 form-group">
                                    <input type="text" id="mname" class="form-control form-control-lg" placeholder="M.I.">
                                </div>
                                <div class="col-md-4 form-group">
                                    <input type="text" id="lname" class="form-control form-control-lg" placeholder="Last Name">
                                </div>
                            </div>
                            <input type="text" id="gender" class="form-control form-control-lg mb-2" placeholder="gender">
                            <input type="text" id="type" class="form-control form-control-lg mb-2" placeholder="Role">
                            <input type="text" id="school_id" class="form-control form-control-lg mb-2" placeholder="School ID">
                        </div>
                    </div>
                </div>
            </div>

            <!-- RFID FORM -->
            <form action="" id="rfid-form">
                <div>
                    <input type="text" id="rfid" name="rfid" required autofocus>
                </div>
            </form>


            <div class="card">
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
                            $rec = $conn->query('SELECT r.id, r.rfid_num, r.timein, r.timeout, 
                                    COALESCE(s.fname, e.fname) as fname, 
                                    COALESCE(s.mname, e.mname) as mname, 
                                    COALESCE(s.lname, e.lname) as lname
                            FROM records r
                            LEFT JOIN students s ON r.rfid_num = s.rfid
                            LEFT JOIN employees e ON r.rfid_num = e.rfid
                            ORDER BY GREATEST(r.timein, IFNULL(r.timeout, r.timein)) DESC
                            LIMIT 5;
                        ');

                            while ($row = $rec->fetch_assoc()): ?>
                                <tr>
                                    <td class="text-center"><?= $row['fname'] . ' ' . $row['mname'] . ' ' . $row['lname']  ?></td>
                                    <td class="text-center"><?= date('F d, Y -- h:i A', strtotime($row['timein'])) ?></td>
                                    <td class="text-center"><?= $row['timeout'] ? date('F d, Y -- h:i A', strtotime($row['timeout'])) : '------' ?></td>
                                </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </div>




        </div>
    </section>

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
            $('#mname').val("");
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
            $('#mname').val(data.success ? data.mname : defaultVal);
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