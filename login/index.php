<?php

// disable on mobile devices
$mobileAgents = [
    'Android',
    'iPhone',
    'iPad',
    'iPod',
    'BlackBerry',
    'BB10',
    'IEMobile',
    'Windows Phone',
    'Opera Mini',
    'Opera Mobi',
    'Mobile',
    'webOS',
    'Fennec',
    'Silk',
    'Kindle',
    'PlayBook',
    'Nokia',
    'Mobi',
    'smartphone',
    'tablet',
    'iPad Pro',
    'Macintosh; Intel Mac OS X'
];

$userAgent = $_SERVER['HTTP_USER_AGENT'];

$isMobile = false;
foreach ($mobileAgents as $agent) {
    if (stripos($userAgent, $agent) !== false) {
        $isMobile = true;
        break;
    }
}

if ($isMobile) {
    echo "This website is not accessible on mobile devices.";
    exit();
}
// disable on mobile devices




session_start();
error_reporting(0);

include 'db_connect.php';

if (isset($_SESSION['login_id'])) {
    header('Location: ../');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>

    <link rel="icon" type="image/png" href="../assets/defaults/evsu.png">

    <?php
    include 'header.php';
    include 'db_connect.php';

    ?>

</head>

<body>
    <div class="container">


        <!-- content -->
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : "login";
        include $page . '.php';
        ?>
        <!-- end content -->


    </div>


    <!-- Toast Alert -->
    <div class="position-fixed" style="top:50px; right: 50px; padding: 1rem; z-index: 1050;">
        <div class="toast" id="alert_toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-body text-white" style="font-size:18px;">
            </div>
        </div>
    </div>
    <!-- end Toast Alert -->

</body>

<?php
include 'footer.php';
?>



<script>
    window.onload = function() {
        start_load();

        end_load();
    };

    //alert toast
    window.alert_toast = function($msg = 'TEST', $bg = 'success') {
        $('#alert_toast').removeClass('bg-success')
        $('#alert_toast').removeClass('bg-danger')
        $('#alert_toast').removeClass('bg-info')
        $('#alert_toast').removeClass('bg-warning')

        if ($bg == 'success')
            $('#alert_toast').addClass('bg-success')
        if ($bg == 'danger')
            $('#alert_toast').addClass('bg-danger')
        if ($bg == 'info')
            $('#alert_toast').addClass('bg-info')
        if ($bg == 'warning')
            $('#alert_toast').addClass('bg-warning')
        $('#alert_toast .toast-body').html($msg + '  <i class="fa-solid fa-circle-exclamation"></i> ')
        $('#alert_toast').toast({
            delay: 3000
        }).toast('show');
    }



    function validateForm(form) {
        const invalidPattern = /(--|'|`|<|>|=)/;
        let isValid = true;

        $(form).find('input').each(function() {
            if (invalidPattern.test($(this).val())) {
                alert_toast('Invalid. Do not input special character!', 'danger');
                isValid = false;
                return false;
            }
        });

        return isValid;
    }
</script>

</html>