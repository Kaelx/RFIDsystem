<script>
    var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
    if (page) {
        $('ul.nav-sidebar a').each(function () {
            var href = $(this).attr('href');
            if (href && href.indexOf('page=' + page) !== -1) {
                $(this).addClass('active');
            }
        });
    }
</script>