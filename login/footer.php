<script>
    window.start_load = function() {
        $('body').prepend('<div id="preloader2"></div>')
    }

    window.end_load = function() {
        $('#preloader2').fadeOut('fast', function() {
            $(this).remove();
        })
    }

    $(document).ready(function(){
        $('#login-form').submit(function(e){
            e.preventDefault()
            start_load()
            $.ajax({
                url:'ajax.php?action=login',
                method:'POST',
                data:$(this).serialize(),
                success:function(resp){
                    end_load()
                    if(resp == 1){
                        location.href = 'index.php?page=home';
                    } else if(resp == 2){
                        alert('Wrong password.');
                    }else if(resp == 3){
                        alert('No account found.');
                    }else{
                        alert('An error occured.')
                    }
                }
            })
        })
    })
</script>
