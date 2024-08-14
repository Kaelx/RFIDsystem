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


    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <center>
                <div class="card">
                    <div id="clock"></div>
                    <div id="date"></div>
                </div>
            </center>
            <h1 class="text-center">Please scan your RFID!</h1>

            <div id="rfid-form">
                <input type="text" id="rfid" name="rfid" required autofocus>
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


    $(document).ready(function() {
        setInterval(function() {
            $('#rfid').focus();
        }, 500);

        $('body').mousemove(function() {
            $('#rfid').focus();
        });

        $('#rfid').keypress(function(e) {
            if (e.which == 13) {
                const currentTime = document.getElementById('clock').innerText;
                const currentDate = document.getElementById('date').innerText;
                alert(`RFID: ${$(this).val()}\nTime: ${currentTime}\nDate: ${currentDate}`);
                location.reload();
            }
        });
    });
</script>