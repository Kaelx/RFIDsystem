<div class="content-wrapper">

    <!-- RFID FORM -->
    <form action="" id="rfid-form">
        <div>
            <input type="text" id="rfid" name="rfid" required autofocus>
        </div>
    </form>

    <!-- Main content -->
    <section class="content py-5">
        <div class="container-fluid">

            <!-- Clock and Date Display -->
            <center>
                <div class="mb-4">
                    <div id="clock" class="h3 text-primary font-weight-bold"></div>
                    <div id="date" class="h5"></div>
                </div>
            </center>

            <!-- User Information Display -->
            <div class="card shadow m-5">
                <div class="card-body">
                    <div class="row align-items-center justify-content-center">
                        <div class="col-md-3 mr-5 text-center">
                            <img id="profile-img" src="assets/img/AdminLogo.png" class="img-fluid mb-3" alt="Avatar" style="object-fit: cover; max-width: 130px"></img>
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

        </div>


</div>
</section>

</div>

<script>
    function updateClock() {
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12;
        const date = now.toLocaleDateString();
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
        if (e.which == 13) {
            e.preventDefault();

            $.ajax({
                url: 'ajax.php?action=fetch_data',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                success: function(resp) {
                    let data = JSON.parse(resp);

                    if (data.success) {
                        $('#fname').val(data.fname);
                        $('#lname').val(data.lname);
                        $('#type').val(data.cat_name);
                        $('#department').val(data.dept_name);
                        $('#program').val(data.prog_name);
                        $('#profile-img').attr('src', 'assets/img/' + data.img_path);

                        $('#rfid').val("");

                        setTimeout(function() {
                            location.reload()
                        }, 10000)
                    } else {
                        $('#fname').val("Unknown");
                        $('#lname').val("Unknown");
                        $('#type').val("Unknown");
                        $('#department').val("Unknown");
                        $('#program').val("Unknown");
                        $('#profile-img').attr('src', 'assets/img/' + '23959955.jpg');
                        $('#rfid').val("");

                        setTimeout(function() {
                            location.reload()
                        }, 10000)
                    }
                }
            });
        }
    });
</script>