<script>
    window.start_load = function() {
        $('body').prepend('<div id="preloader2"></div>')
    }
    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        })
    }


    $(document).ready(function() {

        let isFullscreen = false;

        $('#screenIcon').click(function() {
            if (!isFullscreen) {
                enterFullscreen(document.documentElement);
                $(this).removeClass('fa-maximize').addClass('fa-minimize');
            } else {
                exitFullscreen();
                $(this).removeClass('fa-minimize').addClass('fa-maximize');
            }
            isFullscreen = !isFullscreen;
        });



        $(document).on('fullscreenchange', function() {
            if (!document.fullscreenElement) {
                $('#screenIcon').removeClass('fa-minimize').addClass('fa-maximize');
                isFullscreen = false;
            } else {
                $('#screenIcon').removeClass('fa-maximize').addClass('fa-minimize');
                isFullscreen = true;
            }
        });



        function enterFullscreen(element) {
            if (element.requestFullscreen) element.requestFullscreen();
        }

        function exitFullscreen() {
            if (document.exitFullscreen) document.exitFullscreen();
        }
    });
</script>