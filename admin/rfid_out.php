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

    .content-wrapper {
        background-color: #edd05d;
        z-index: 2;
    }
</style>


<script>
    window.onload = function() {
        const preloader = document.querySelector('.preloader');
        preloader.style.transition = 'opacity 0.35s ease';
        preloader.style.opacity = '0';

        setTimeout(function() {
            preloader.style.display = 'none';
        }, 200);
    };
</script>

<div class="preloader flex-column justify-content-center align-items-center">
</div>


<div class="content-wrapper">

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <!-- Clock and Date Display -->
            <center>
                <div class="mb-3">
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

            <div id="student-card" style="display: none;">
                <div class="card-body">
                    <!-- STUDENT Information Display -->
                    <div class="row justify-content-center">
                        <div class="col-md-5 mr-3 text-center">
                            <img id="student-img" src="assets/img/blank-img.png" class="img-fluid mb-4" alt="Avatar" style="object-fit: cover; width: 620px; height: 620px; border: 4px solid #a91414;">
                        </div>
                        <div class="col-md-5 ml-3" style="margin-top:80px;">
                            <h1 id="sname" style="font-size: 56px; font-weight:bold; color: #a91414; font-family:'Times New Roman', Times, serif ;"></h1>
                            <h1 id="sschool_id" style="font-size: 58px; font-weight:bold; font-family:'Times New Roman', Times, serif ; margin-bottom:30px;"></h1>
                            <h1 id="sgender" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                            <h1 id="srole" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                            <h1 id="stype" style="font-size: 42px; font-style:italic; font-family: Arial, sans-serif; margin-bottom:30px;"></h1>
                            <h1 id="sdept_name" style="font-size: 38px; font-style:italic; font-family: Arial, sans-serif; margin-bottom:30px;"></h1>
                            <h1 id="sprog_name" style="font-size: 38px; font-style:italic; font-family: Arial, sans-serif;"></h1>
                        </div>
                    </div>
                </div>
            </div>

            <div id="employee-card" style="display: none;">
                <div class="card-body">
                    <!-- STUDENT Information Display -->
                    <div class="row justify-content-center">
                        <div class="col-md-5 mr-3 text-center">
                            <img id="employee-img" src="assets/img/blank-img.png" class="img-fluid mb-4" alt="Avatar" style="object-fit: cover; width: 620px; height: 620px; border: 4px solid #a91414;">
                        </div>
                        <div class="col-md-5 ml-3" style="margin-top:80px;">
                            <h1 id="ename" style="font-size: 56px; font-weight:bold; color: #a91414; font-family:'Times New Roman', Times, serif ;"></h1>
                            <h1 id="eschool_id" style="font-size: 58px; font-weight:bold; font-family:'Times New Roman', Times, serif ; margin-bottom:30px;"></h1>
                            <h1 id="egender" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                            <h1 id="erole" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif; margin-bottom:30px;"></h1>
                            <h1 id="etype" style="font-size: 42px; font-style:italic; font-family: Arial, sans-serif; margin-bottom:30px;"></h1>
                        </div>
                    </div>
                </div>
            </div>


            <div id="vendor-card" style="display: none;">
                <div class="card-body">
                    <!-- STUDENT Information Display -->
                    <div class="row justify-content-center">
                        <div class="col-md-5 mr-3 text-center">
                            <img id="vendor-img" src="assets/img/blank-img.png" class="img-fluid mb-4" alt="Avatar" style="object-fit: cover; width: 620px; height: 620px; border: 4px solid #a91414;">
                        </div>
                        <div class="col-md-5 ml-3" style="margin-top:80px;">
                            <h1 id="cvname" style="font-size: 56px; font-weight:bold; color: #a91414; font-family:'Times New Roman', Times, serif ;"></h1>
                            <h1 id="cvgender" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                            <h1 id="cvrole" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                        </div>
                    </div>
                </div>
            </div>


            <div id="visitor-card" style="display: none;">
                <div class="card-body">
                    <!-- STUDENT Information Display -->
                    <div class="row justify-content-center">
                        <div class="col-md-5 mr-3 text-center">
                            <img id="visitor-img" src="assets/img/blank-img.png" class="img-fluid mb-4" alt="Avatar" style="object-fit: cover; width: 620px; height: 620px; border: 4px solid #a91414;">
                        </div>
                        <div class="col-md-5 ml-3" style="margin-top:80px;">
                            <h1 id="vname" style="font-size: 56px; font-weight:bold; color: #a91414; font-family:'Times New Roman', Times, serif ;"></h1>
                            <h1 id="vgender" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                            <h1 id="vrole" style="font-size: 42px; font-weight:bold; font-family: Arial, sans-serif;"></h1>
                        </div>
                    </div>
                </div>
            </div>



            <div id="error-card" style="display: none;">
                <div class="card-body">
                    <!-- error Information Display -->
                    <div class="row align-items-center justify-content-center">
                        <div class="text-center">
                            <img id="error-img" src="assets/img/blank-img.png" class="img-fluid rounded-circle" alt="Avatar" style="object-fit: cover; width: 620px; height: 620px;">
                        </div>
                    </div>

                </div>
            </div>

            <div id="cooldown-card" style="display: none;">
                <div class="d-flex justify-content-center align-items-center">
                    <p id="cooldown-message" style="margin-top: 200px; font-weight:bold; font-size: 56px;"></p>
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

            $('#visitor-card').hide();
            $('#student-card').hide();
            $('#employee-card').hide();
            $('#vendor-card').hide();
            $('#error-card').hide();
            $('#cooldown-card').hide();
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






    let isSubmitting = false;

    $('#rfid-form').keypress(function(e) {
        if (e.which === 13) { // Checks if Enter key is pressed
            e.preventDefault();

            if (isSubmitting) return; // Prevents further submission if already submitting

            isSubmitting = true; // Lock submission

            start_load();
            $.ajax({
                url: 'ajax.php?action=fetch_data_out',
                data: new FormData(this),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                success: function(resp) {
                    sessionStorage.setItem('responseData', resp);
                    location.reload();
                },
                complete: function() {
                    isSubmitting = false; // Unlock submission once done
                }
            });
        }
    });



    $(document).ready(function() {
        const responseData = sessionStorage.getItem('responseData');
        if (responseData) {

            sessionStorage.removeItem('responseData');
            const data = JSON.parse(responseData);
            const imgPath = data.success ? `assets/img/${data.img_path}` : 'assets/img/unauth-img.png';

            if (data.success) {
                const audio = new Audio('assets/defaults/alert_success.mp3');
                audio.play();
            } else if (data.cooldown) {
                $('#cooldown-message').html(data.message + ' <i class="fa-solid fa-user-check"></i>');
                $('#cooldown-card').show();
                $('#rfid').val("");

                const audio = new Audio('assets/defaults/alert_success.mp3');
                audio.play();
                return;
            } else {
                const audio = new Audio('assets/defaults/alert_beep.mp3');
                audio.play();
            }

            var role = data.role_name;
            var fullName = data.fname + ' ' + data.lname + ' ' + data.sname;

            if (role == "Student") {
                $('#student-img').attr('src', imgPath);
                $('#sname').text(fullName.toUpperCase());
                $('#sgender').text(data.gender);
                $('#srole').text(data.role_name);
                $('#stype').text(data.employee_type);
                $('#sprog_name').text(data.prog_name);
                $('#sdept_name').text(data.dept_name);
                $('#sschool_id').text(data.school_id);


                $('#rfid').val("");
                $('#student-card').show();



            } else if (role == "Employee") {
                $('#employee-img').attr('src', imgPath);
                $('#ename').text(fullName.toUpperCase());
                $('#egender').text(data.gender);
                $('#erole').text(data.role_name);
                $('#etype').text(data.employee_type);
                $('#eprog_name').text(data.prog_name);
                $('#edept_name').text(data.dept_name);
                $('#eschool_id').text(data.school_id);

                $('#rfid').val("");
                $('#employee-card').show();


            } else if (role == "Visitor") {
                $('#visitor-img').attr('src', imgPath);
                $('#vname').text(fullName.toUpperCase());
                $('#vgender').text(data.gender);
                $('#vrole').text(data.role_name);
                $('#vtype').text(data.employee_type);
                $('#vprog_name').text(data.prog_name);
                $('#vdept_name').text(data.dept_name);
                $('#vschool_id').text(data.school_id);


                $('#rfid').val("");
                $('#visitor-card').show();



            } else if (role == "Vendor") {
                $('#vendor-img').attr('src', imgPath);
                $('#cvname').text(fullName.toUpperCase());
                $('#cvgender').text(data.gender);
                $('#cvrole').text(data.role_name);
                $('#cvtype').text(data.employee_type);
                $('#cvprog_name').text(data.prog_name);
                $('#cvdept_name').text(data.dept_name);
                $('#cvschool_id').text(data.school_id);


                $('#rfid').val("");
                $('#vendor-card').show();



            } else {
                $('#error-img').attr('src', imgPath);
                $('#rfid').val("");
                $('#error-card').show();
            }

            console.log(responseData);
        }
    });
</script>