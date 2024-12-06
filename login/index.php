<?php
ob_start();
session_start();
error_reporting(0);

include '../admin/db_connect.php';

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

    <link rel="icon" type="image/png" href="../assets/defaults/rfid.png">

    <?php
    include 'header.php';
    ?>

</head>

<body>

    <div>
        <!-- content -->
        <?php
        $exclude = ['index'];
        $page = isset($_GET['page']) ? basename($_GET['page']) : 'login';

        if (in_array($page, $exclude) || !file_exists($page . '.php')) {
            $page = 'login';

            header('Location: index.php?page=' . $page);
            exit;
        }

        include $page . '.php';
        ?>
        <!-- end content -->
    </div>




    <!-- Toast Alert -->
    <div class="position-fixed" style="top:50px; right: 1px; padding: 1rem; z-index: 99999;">
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
        const invalidPattern = /(--|'|.'|."|".|'.|`|<|>|=)/;
        let isValid = true;

        $(form).find('input').each(function() {
            if (invalidPattern.test($(this).val())) {
                alert_toast('Invalid. Do not input special character', 'danger');
                isValid = false;
                return false;
            }
        });

        return isValid;
    }
</script>

</html>