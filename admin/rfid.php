<div class="content-wrapper">

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
    <section class="content">
        <div class="container-fluid">

            <div class="card shadow-none">
                <div class="card-body">
                    <!-- Clock and Date Display -->
                    <center>
                        <div class="mb-4">
                            <div id="clock" class="display-2 font-weight-bold"></div>
                            <div id="date" class="h2"></div>
                        </div>
                    </center>
                    <!-- User Information Display -->
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-md-5 text-center mr-5">
                            <img id="profile-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; width: 700px; height: 700px;">
                        </div>

                        <div class="col-md-5 ml-5">
                            <div class="col-md-9">
                                <input type="text" id="name" class="form-control form-control-lg mb-5" placeholder="Name" style="font-size: 48px;">
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="gender" class="form-control form-control-lg mb-5" placeholder="Gender" style="font-size: 48px;">
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="type" class="form-control form-control-lg mb-5" placeholder="Role" style="font-size: 48px;">
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="school_id" class="form-control form-control-lg mb-5" placeholder="School ID" style="font-size: 48px;">
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Add any other content here -->

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

            $('#name').val("");
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

            var fullName = data.success ? data.fname + ' ' + data.lname : defaultVal;
            $('#name').val(fullName);
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