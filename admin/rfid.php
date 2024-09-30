<style>
    body {
        position: relative;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    body::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-image: url('./assets/defaults/evsu.png');
        /* Ensure the path is correct */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        filter: blur(5px);
        z-index: 1;
        opacity: 0.02;
        /* Optional: makes sure background is slightly visible */
    }
</style>


<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Clock and Date Display -->
            <center>
                <div class="mb-2">
                    <div id="clock" class="display-2 font-weight-bold"></div>
                    <div id="date" class="h2"></div>
                </div>
            </center>
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

            <div id="student-card" class="card" style="display: none;">
                <div class="card-body">
                    <!-- STUDENT Information Display -->
                    <div class="card-header">Student</div>
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-md-5 text-center mr-5">
                            <img id="student-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; width: 700px; height: 700px; border: 5px solid #a91414;">
                        </div>
                    </div>

                </div>
            </div>


            <div id="visitor-card" class="card" style="display: none;">
                <div class="card-body">
                    <!-- Visitor Information Display -->
                    <div class="card-header">Visitor</div>
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-md-5 text-center mr-5">
                            <img id="visitor-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; width: 700px; height: 700px; border: 5px solid #a91414;">
                        </div>
                    </div>

                </div>
            </div>

            <div id="error-card" class="card" style="display: none;">
                <div class="card-body">
                    <!-- error Information Display -->
                    <div class="card-header">error</div>
                    <div class="row align-items-center justify-content-center mt-5">
                        <div class="col-md-5 text-center mr-5">
                            <img id="error-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle mb-4" alt="Avatar" style="object-fit: cover; width: 700px; height: 700px; border: 5px solid #a91414;">
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>
</div>





<script>
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

            $('#visitor-card').hide();
            $('#student-card').hide();
            $('#error-card').hide();

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
            const imgPath = data.success ? `assets/img/${data.img_path}` : 'assets/img/unauth-img.png';

            var role = data.success ? data.role_name : defaultVal;

            if (role == "Student") {
                $('#student-img').attr('src', imgPath);
                $('#rfid').val("");


                $('#student-card').show();

            } else if (role == "Visitor") {
                $('#visitor-img').attr('src', imgPath);
                $('#rfid').val("");


                $('#visitor-card').show(); 

            }else{
                $('#error-img').attr('src', imgPath);
                $('#rfid').val("");

                $('#error-card').show(); 
            }

            console.log(responseData);

            if (!data.success) {
                const audio = new Audio('assets/defaults/alert_beep.mp3');
                audio.play();
            }
        }
    });
</script>