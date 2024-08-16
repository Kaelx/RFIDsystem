<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
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

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div>
                <div id="clock"></div>
                <div id="date"></div>
            </div>
            <div>
                <img id="profile-img" src="assets/img/AdminLogo.png" alt="Avatar">
                <div id="fname"></div>
                <div id="lname"></div>
                <div id="type"></div>
                <div id="department"></div>
                <div id="program"></div>
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
                        $('#fname').text(data.fname);
                        $('#lname').text(data.lname);
                        $('#type').text(data.cat_name);
                        $('#department').text(data.dept_name);
                        $('#program').text(data.prog_name);
                        $('#profile-img').attr('src', 'assets/img/' + data.img_path);
                    } else {
                        alert_toast('No data found for this RFID.', 'danger');
                    }
                }
            });
        }
    });
</script>
