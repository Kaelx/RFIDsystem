<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication</title>
    
    <?php
    include 'header.php';
    include 'db_connect.php';

    if(isset($_SESSION['login_id'])) {
        header('Location: ../');
    }
    
    ?>

</head>

<body>
    
    <div class="container">

    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : "login";

    $allowed_pages = ['login', 'forgotpass'];
    if (in_array($page, $allowed_pages)) {
        include $page . '.php';
    } else {
        header('Location: index.php?page=login');
    }
    ?>

</div>

</body>

<?php
include 'footer.php';
?>



<script>
window.onload = function() {
    start_load();

    end_load();
};

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

</html>