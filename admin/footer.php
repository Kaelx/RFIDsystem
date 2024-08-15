<script>
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if (page) {
        $('ul.nav-sidebar a').each(function() {
            var href = $(this).attr('href');
            if (href && href.indexOf('page=' + page) !== -1) {
                $(this).addClass('active');
            }
        });
    }




    // Check the state of the sidebar from localStorage
    if (localStorage.getItem('sidebarState') === 'collapsed') {
        // Trigger the template's pushmenu toggle if sidebar was collapsed
        $('body').addClass('sidebar-collapse'); // Ensure the body has the correct class
    }

    // Handle sidebar toggle click
    $('[data-widget="pushmenu"]').on('click', function() {
        var isCollapsed = $('body').hasClass('sidebar-collapse'); // Check the current state

        if (isCollapsed) {
            // Sidebar is collapsed, so it's being expanded now
            localStorage.setItem('sidebarState', 'expanded');
        } else {
            // Sidebar is expanded, so it's being collapsed now
            localStorage.setItem('sidebarState', 'collapsed');
        }
    });




    window._conf = function($msg = '', $func = '', $params = []) {
        $('#confirm_modal #confirm').attr('onclick', $func + "(" + $params.join(',') + ")")
        $('#confirm_modal .modal-body').html($msg)
        $('#confirm_modal').modal('show')
    }



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
        $('#alert_toast .toast-body').html($msg)
        $('#alert_toast').toast({
            delay: 3000
        }).toast('show');
    }
</script>