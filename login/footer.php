<script>
    window.start_load = function() {
        $('body').prepend('<div id="preloader2"></div>')
    }

    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        })
    }

</script>
