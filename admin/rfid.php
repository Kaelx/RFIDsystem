<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            <!-- RFID FORM -->
            <form action="" id="rfid-form">
                <div>
                    <input type="text" id="rfid" name="rfid" required autofocus>
                </div>
            </form>


            <div class="card shadow">
                <div class="card-body">

                    <!-- Clock and Date Display -->
                    <center>
                        <div class="mb-4">
                            <div id="clock" class="h3 font-weight-bold"></div>
                            <div id="date" class="h5"></div>
                        </div>
                    </center>

                    <!-- User Information Display -->
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-3 mr-5 text-center">
                            <img id="profile-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-3" alt="Avatar" style="object-fit: cover; max-width: 130px"></img>
                        </div>
                        <div class="col-md-5">

                            <div class="row">
                                <div class="col-md-6 form-group">
                                    <input type="text" id="fname" class="form-control" placeholder="First Name">
                                </div>
                                <div class="col-md-6 form-group">
                                    <input type="text" id="lname" class="form-control" placeholder="Last Name">
                                </div>
                            </div>
                            <input type="text" id="type" class="form-control mb-2" placeholder="Role">
                            <input type="text" id="department" class="form-control mb-2" placeholder="Department">
                            <input type="text" id="program" class="form-control mb-2" placeholder="Program/Course">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-none">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover compact">
                            <thead>
                                <tr>
                                    <th class="text-center"> Employee/Student ID</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Time in</th>
                                    <th class="text-center">Time out</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $rec = $conn->query('SELECT * FROM record order by id desc');
                                while ($row = $rec->fetch_assoc()):
                                ?>
                                    <tr>
                                        <td></td>
                                        <td><?= $row['fname'] . ' ' . $row['lname'] ?></td>
                                        <td class="text-center"><?= (date('F d, Y', strtotime($row['timein']))) . ' -- ' . (date('h:i A', strtotime($row['timein']))) ?></td>
                                        <td class="text-center"><?= $row['timeout'] ? (date('F d, Y', strtotime($row['timeout'])) . ' -- ' . date('h:i A', strtotime($row['timeout']))) : 'N/A'; ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>


        </div>
    </section>

</div>

<script>
    let idleTimer;
    let idleState = false;
    const idleWait = 5000;

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
            $('#department').val("");
            $('#program').val("");
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

            sessionStorage.removeItem('responseData');

            const data = JSON.parse(responseData);
            const defaultVal = "Unknown";
            const imgPath = data.success ? `assets/img/${data.img_path}` : 'assets/img/unauth-img.jpg';

            $('#fname').val(data.success ? data.fname : defaultVal);
            $('#lname').val(data.success ? data.lname : defaultVal);
            $('#type').val(data.success ? data.cat_name : defaultVal);
            $('#department').val(data.success ? data.dept_name : defaultVal);
            $('#program').val(data.success ? data.prog_name : defaultVal);
            $('#profile-img').attr('src', imgPath);
            $('#rfid').val("");
        }
    });




    $('table').DataTable({
        searching: false,
        ordering: false,
    });
</script>